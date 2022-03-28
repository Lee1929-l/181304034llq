<?php

require_once APPPATH.'libraries/PHPExcel.php';

class Php_excel
{
    private $Excel_obj;

    function __construct()
    {
        $this->Excel_obj = new PHPExcel();
    }

    public function test_excel()
    {
        $sort_arr = array('A', 'B', 'C', 'D');
        $tmp_data = array('序号', '姓名', '年龄', '性别');
        $dict_arr = array('sort'=>'A', 'name'=>'B', 'age'=>'C', 'sex'=>'D');
        $data = array(
            array(
                'name' => '张三',
                'age' => '11',
                'sex' => '男'
            ),
            array(
                'name' => '李四',
                'age' => '18',
                'sex' => '男'
            ),
            array(
                'name' => '王五',
                'age' => '15',
                'sex' => '女'
            ),
        );
        foreach ($tmp_data as $key => $value) {
            $index = $sort_arr[$key].'1';
            $this->Excel_obj->getActiveSheet()->setCellValue($index, $value);
        }
        $data_row = 2;
        foreach ($data as $k => $val) {
            $row_num = $data_row+$k;
            $val['sort'] = $k+1;
            foreach ($val as $field => $v) {
                $index = $dict_arr[$field].$row_num;
                $this->Excel_obj->getActiveSheet()->setCellValue($index, $v);
            }
        }
        $obj_writer = PHPExcel_IOFactory::createWriter($this->Excel_obj, 'Excel2007');
        $file_name = 'test1.xls';
        $file_path = APPPATH.'../excel_test/'.$file_name;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $obj_writer->save($file_path);
        return $file_name;
    }
}
