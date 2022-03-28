<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	private $header_result;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('database_model');
		$this->load->model('achieve_model');
		$this->load->model('file_upload');
		$this->load->helper('file');
		$this->load->library('upload');
		$this->header_result = $this->achieve_model->db_tag('tag', false)['data'];	//导航标签
		$this->tag2_result = $this->achieve_model->db_tag2('tag', false)['data'];	//按分类查找
		$this->classify_result = $this->achieve_model->db_classify('classify', false)['data'];	//技术领域
		$this->classify2_result = $this->achieve_model->db_classify2('classify', false)['data'];	//项目阶段

		$this->index_mainlibs = $this->achieve_model->db_tag('tag', false)['data']; // 5个库模块 + 科技资讯 + 创业孵化（ 成果，需求，专家，设备，专利库，创业孵化，科技资讯）
		$this->business_sublibs = $this->achieve_model->db_infonotebyid('childtag', array('tag_id' => '7'), false)['data']; // 所属创业孵化的子模块：孵化器众创空间，创新创业学院，创新创业团队，创新创业导师，创新创业活动
		$this->tech_informations = $this->achieve_model->db_infonotebyid('childtag', array('tag_id' => '8'), false)['data']; // 科技资讯  新聞列表
		// 新闻资讯
		$this->tech_news = array();
		$result_news = $this->achieve_model->db_newsindex('vw_childtag_info_detail_content', array('tag_id' => 8, 'childtag_id' => 3), false);
		if ($result_news['code']) {
			$this->tech_news = $result_news['data'];
		}
	}

	public function index()
	{
		$this->is_mobile = $this->input->get('is_mobile');
		// if (!$this->is_mobile) {
		// 	$this->is_mobile = 1;
		// }
		//	子标签名称
		$tag_result = $this->achieve_model->db_news_childtag('childtag', false)['data'];
		$childtag_id = 8;

		// get_infonote_title
		// 新闻资讯
		$infonote_news = array();
		$result_news = $this->achieve_model->db_newsindex('vw_childtag_info_detail_content', array('tag_id' => 8, 'childtag_id' => 3), false);
		if ($result_news['code']) {
			$infonote_news = $result_news['data'];
		}

		//	通知公告 infonote_notice
		$infonote_notice = array();
		$result_notice = $this->achieve_model->db_newsindex('vw_childtag_info_detail_content', array('tag_id' => 8, 'childtag_id' => 4), false);
		if ($result_notice['code']) {
			$infonote_notice = $result_notice['data'];
		}

		// 政策法规 infonote_regulation
		$infonote_regulation = array();
		$result_regulation = $this->achieve_model->db_newsindex('vw_childtag_info_detail_content', array('tag_id' => 8, 'childtag_id' => 5), false);
		if ($result_regulation['code']) {
			$infonote_regulation = $result_regulation['data'];
		}

		// 5个库
		$lib_tag = array();
		$select_where = "id='1' OR id='2' OR id='2' OR id='3' OR id='4' OR id='5'";
		$lib_result = $this->achieve_model->db_taglib('tag', $select_where, false);
		if ($lib_result['code']) {
			$lib_tag = $lib_result['data'];
		}

		// 创新孵化 childtag_id 12678
		$entrepre_tag = array();
		$select_where = "id='1'OR id='2' OR id='6' OR id='7' OR id='8'";
		$entrepre_result = $this->achieve_model->db_taglib('childtag', $select_where, false);
		if ($entrepre_result['code']) {
			$entrepre_tag = $entrepre_result['data'];
		}

		//高校
		$this->college = array();
		$result_college = $this->achieve_model->db_filenote(
			'college',
			'file',
			'file.id=college.file_id',
			'left outer',
			array('college.is_delete' => 0),
			false
		);
		if ($result_college['code']) {
			$this->college = $result_college['data'];
		}
		//企业
		$this->company = array();
		$result_company = $this->achieve_model->db_filenote(
			'company',
			'file',
			'file.id=company.file_id',
			'left outer',
			array('company.is_delete' => 0),
			false
		);
		if ($result_company['code']) {
			$this->company = $result_company['data'];
		}


		//合作案例
		$cooperationcase = array();
		$case_result = $this->achieve_model->db_pagenition('infonote', 1, 6, 3, false);
		// $case_result = $this->achieve_model->db_get('infonote', '*', array('tag_id' => 6), false);
		if ($case_result['code']) {
			$cooperationcase = $case_result['data'];
		}
		// print_r($cooperationcase);
		// exit;

		$this->case = array();
		$result_case = $this->achieve_model->db_filenote(
			'infonote',
			'file',
			'file.id=infonote.file_id',
			'left outer',
			array(
				'infonote.is_delete' => 0,
				'tag_id' => 6
			),
			false
		);
		if ($result_case['code']) {
			$this->case = $result_case['data'];
		}
		if ($this->is_mobile == 1) {
			$this->load->view(
				'/mobile_view/mobile_index_view.php',
				array(
					'index_mainlibs' => $this->index_mainlibs,
					'business_sublibs' => $this->business_sublibs,
					'tech_informations' => $this->tech_informations,
					'tech_news' => $this->tech_news,
					'college' => $this->college,
					'company' => $this->company,
					'case' => $this->case
				)
			);
		} else {
			$this->load->view('index', array(
				'tag_info' => $this->header_result,
				'tag2_info' => $this->tag2_result,
				'classify_info' => $this->classify_result,
				'classify2_info' => $this->classify2_result,
				// 子标签名称
				'child_tag' => $tag_result,
				'infonote_news' => $infonote_news,
				'infonote_notice' => $infonote_notice,
				'infonote_regulation' => $infonote_regulation,
				'lib_tag' => $lib_tag,				//成果库，需求库，专家库，专利库，设备库
				'entrepre_tag' => $entrepre_tag,	//创新孵化 子标签
				'college' => $this->college,		//高校
				'company' => $this->company,		//企业战士
				'cooperationcase' => $cooperationcase,		//合作案例
			));
		}
	}
}