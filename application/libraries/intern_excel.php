<?php

require_once APPPATH . 'libraries/PHPExcel.php';

class intern_excel
{
    private $Excel_obj;

    function __construct()
    {
        $this->Excel_obj = new PHPExcel();
        
    }

    public function agree_excel($arr)
    {
        $sort_arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G');
        $tmp_data = array('序号', '实习姓名', '毕业院校', '学习专业', '实习意向', '入职时间', '联系电话');
        $dict_arr = array(
            'sort' => 'A',
            'intern_name' => 'B',
            'intern_school' => 'C',
            'intern_major' => 'D',
            'intern_need' => 'E',
            'join_time' => 'F',
            'intern_tel' => 'G'
        );
        foreach ($tmp_data as $key => $value) {
            $this->Excel_obj->getActiveSheet()->getStyle($sort_arr[$key] . '1')->getFont()->setBold(true);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $index = $sort_arr[$key] . '1';
            $this->Excel_obj->getActiveSheet()->setCellValue($index, $value);
        }
        $data_row = 2;
        foreach ($arr as $k => $val) {
            $row_num = $data_row+$k;
            $val['sort'] = $k+1;
            foreach ($val as $field => $v) {
                $index = $dict_arr[$field].$row_num;
                $this->Excel_obj->getActiveSheet()->setCellValue($index, $v);
            }
        }
        $obj_writer = PHPExcel_IOFactory::createWriter($this->Excel_obj, 'Excel2007');
        $file_name = '在岗实习生名单.xls';
        $file_path = APPPATH.'../excel_test/'.$file_name;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $obj_writer->save($file_path);
        return $file_name;
    }

    public function intern_excel($arr)
    {
        $sort_arr = array('A', 'B', 'C', 'D', 'E', 'F', 'G');
        $tmp_data = array('序号', '实习姓名', '毕业院校', '学习专业', '实习意向', '申请时间', '联系电话');
        $dict_arr = array(
            'sort' => 'A',
            'intern_name' => 'B',
            'intern_school' => 'C',
            'intern_major' => 'D',
            'intern_need' => 'E',
            'sub_time' => 'F',
            'intern_tel' => 'G'
        );
        foreach ($tmp_data as $key => $value) {
            $this->Excel_obj->getActiveSheet()->getStyle($sort_arr[$key] . '1')->getFont()->setBold(true);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('B')->setWidth(10);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $this->Excel_obj->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $index = $sort_arr[$key] . '1';
            $this->Excel_obj->getActiveSheet()->setCellValue($index, $value);
        }
        $data_row = 2;
        foreach ($arr as $k => $val) {
            $row_num = $data_row+$k;
            $val['sort'] = $k+1;
            foreach ($val as $field => $v) {
                $index = $dict_arr[$field].$row_num;
                $this->Excel_obj->getActiveSheet()->setCellValue($index, $v);
            }
        }
        $obj_writer = PHPExcel_IOFactory::createWriter($this->Excel_obj, 'Excel2007');
        $file_name = '实习生报名名单.xls';
        $file_path = APPPATH.'../excel_test/'.$file_name;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $obj_writer->save($file_path);
        return $file_name;
    }

}
