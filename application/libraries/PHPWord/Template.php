<?php
/**
 * PHPWord
 *
 * Copyright (c) 2011 PHPWord
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPWord
 * @package    PHPWord
 * @copyright  Copyright (c) 010 PHPWord
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    Beta 0.6.3, 08.07.2011
 */


/**
 * PHPWord_DocumentProperties
 *
 * @category   PHPWord
 * @package    PHPWord
 * @copyright  Copyright (c) 2009 - 2011 PHPWord (http://www.codeplex.com/PHPWord)
 */
class PHPWord_Template {

    /**
     * ZipArchive
     *
     * @var ZipArchive
     */
    private $_objZip;

    /**
     * Temporary Filename
     *
     * @var string
     */
    private $_tempFileName;

    /**
     * Document XML
     *
     * @var string
     */
    private $_documentXML;

    private $tempDocumentFooters = array();


    /**
     * Create a new Template Object
     *
     * @param string $strFilename
     */
    public function __construct($strFilename) {
        $path = dirname($strFilename);
        $this->_tempFileName = $path.DIRECTORY_SEPARATOR.time().'.docx';

        copy($strFilename, $this->_tempFileName); // Copy the source File to the temp File

        $this->_objZip = new ZipArchive();
        $this->_objZip->open($this->_tempFileName);

        $this->_documentXML = $this->_objZip->getFromName('word/document.xml');

        $this->tempDocumentMainPart = $this->readPartWithRels($this->getMainPartName());

        $index = 1;
        while (false !== $this->_objZip->locateName($this->getFooterName($index))) {
            $this->tempDocumentFooters[$index] = $this->fixBrokenMacros(
                $this->_objZip->getFromName($this->getFooterName($index))
            );
            $index++;
        }
    }

    protected function fixBrokenMacros($documentPart) {
        $fixedDocumentPart = $documentPart;
        $fixedDocumentPart = preg_replace_callback(
            '|\$[^{]*\{[^}]*\}|U', function ($match) {
                return strip_tags($match[0]);
            }, $fixedDocumentPart
        );  
        return $fixedDocumentPart;
    }

    protected function getFooterName($index) {
        return sprintf('word/footer%d.xml', $index);
    }

    public function setHeader($search, $replace) {
        foreach ($this->tempDocumentFooters as $index => $xml) {
            $this->tempDocumentFooters[$index] = str_replace($search, $replace, $xml);
        }
    }

    //
    public function pre_process($key)
    {
        $this->_documentXML = str_replace($key, '${'.$key.'}', $this->_documentXML);
        //print($this->_documentXML);
    }

    /**
     * Set a Template value
     *
     * @param mixed $search
     * @param mixed $replace
     */
    public function setValue($search, $replace) {

        /*if(substr($search, 0, 2) !== '${' && substr($search, -1) !== '}') {
            //print($search);
            //print("<br>");
            $this->_documentXML = str_replace($search, '${'.$search.'}', $this->_documentXML);
            $search = '${'.$search.'}';
        }*/

        /*if(!is_array($replace)) {
            //$replace = utf8_encode($replace);
            //$replace =iconv('gbk', 'utf-8', $replace);
            //echo $replace;
        }*/
        $replace=str_replace('&','&amp;',$replace);
         $replace=str_replace('<','&lt;',$replace);
         $replace=str_replace('>','&gt;',$replace);
         $replace=str_replace('\'','&quot;',$replace);
         $replace=str_replace('"','&apos;',$replace);
        $replace=str_replace('\n','<w:br />',$replace);
        $this->_documentXML = str_replace($search, $replace, $this->_documentXML);
        
    }

    //
    public function setValueTwo($search, $replace) 
    { 
        $replace=str_replace('&','&amp;',$replace);
         $replace=str_replace('<','&lt;',$replace);
         $replace=str_replace('>','&gt;',$replace);
         $replace=str_replace('\'','&quot;',$replace);
         $replace=str_replace('"','&apos;',$replace);
        $replace=str_replace('\n','<w:br />',$replace);
        $pos = strpos($this->_documentXML, $search); 
        if ($pos !== false) 
        { 
            $this->_documentXML = substr_replace($this->_documentXML, $replace, $pos, strlen($search)); 
        } 
    } 


    /**
     *
     *   
    */
    public function save_image($image_id, $filepath, &$document=null) 
    { 
        if(file_exists($filepath))
        {
            $this->_objZip->deleteName('word/media/'.$image_id);          
            $this->_objZip->addFile($filepath, 'word/media/'.$image_id);
        }
        else
        {
            //echo "avatar not exist!";
            return false;
        }   
    }


    /**
     * Clone a table row
     * 
     * @param mixed $search
     * @param mixed $numberOfClones
     */
    public function cloneRow($search, $numberOfClones,$key_arr) {
        /*if(substr($search, 0, 2) !== '${' && substr($search, -1) !== '}') {
            //$this->_documentXML = str_replace($search, '${'.$search.'}', $this->_documentXML);
            $search = '${'.$search.'}';
        }*/
                
        $tagPos      = strpos($this->_documentXML, $search);
        $rowStartPos = strrpos($this->_documentXML, "<w:tr ", ((strlen($this->_documentXML) - $tagPos) * -1));
        $rowEndPos   = strpos($this->_documentXML, "</w:tr>", $tagPos) + 7;

        /*print($search);
        print("<br>");
        print($tagPos."-".$rowStartPos."-".$rowEndPos);
        print("<br>");
        print($numberOfClones);
        print("<br>");*/

        $result = substr($this->_documentXML, 0, $rowStartPos);
        $xmlRow = substr($this->_documentXML, $rowStartPos, ($rowEndPos - $rowStartPos));
        for ($i = 1; $i <= $numberOfClones; $i++) {
            //old code 
            //$buf = preg_replace('/\$\{(.*?)\}/','\${\\1#'.$i.'}', $xmlRow);   
            //$result .= $buf;

            //new code
            $buf = $xmlRow;
            foreach ($key_arr as $key) 
            {
                $buf = str_replace($key, $key.'#'.$i, $buf);
            }

            $result .= $buf;

        }
        $result .= substr($this->_documentXML, $rowEndPos);

        $this->_documentXML = $result;

        //echo $this->_documentXML;
    }

    /**
     * 条件:表格
     * 要让块消失:numbarofclones 传入0
     */
   public function cloneArea($search,$end, $numberOfClones,$key_arr) {
        /*if(substr($search, 0, 2) !== '${' && substr($search, -1) !== '}') {
            //$this->_documentXML = str_replace($search, '${'.$search.'}', $this->_documentXML);
            $search = '${'.$search.'}';
        }*/
                
        $tagPos      = strpos($this->_documentXML, $search);
         $ends   = strpos($this->_documentXML, $end);
        $rowStartPos = strrpos($this->_documentXML, "<w:tr ", ((strlen($this->_documentXML) - $tagPos) * -1));
        $rowEndPos   = strpos($this->_documentXML, "</w:tr>", $ends) + 7;

        /*print($search);
        print("<br>");
        print($tagPos."-".$rowStartPos."-".$rowEndPos);
        print("<br>");
        print($numberOfClones);
        print("<br>");*/

        $result = substr($this->_documentXML, 0, $rowStartPos);
        $xmlRow = substr($this->_documentXML, $rowStartPos, ($rowEndPos - $rowStartPos));
        for ($i = 1; $i <= $numberOfClones; $i++) {
            //old code 
            //$buf = preg_replace('/\$\{(.*?)\}/','\${\\1#'.$i.'}', $xmlRow);   
            //$result .= $buf;

            //new code
            $buf = $xmlRow;
            foreach ($key_arr as $key) 
            {
                
                    $buf = str_replace($key, $key.'#'.$i, $buf);
                
            }

            $result .= $buf;

        }
        $result .= substr($this->_documentXML, $rowEndPos);

        $this->_documentXML = $result;

        //echo $this->_documentXML;
    }
    /**
     * Save Template
     *
     * @param string $strFilename
     */
    public function save($strFilename) {
        if(file_exists($strFilename)) {
            unlink($strFilename);
        }

        $this->_objZip->addFromString('word/document.xml', $this->_documentXML);

        foreach ($this->tempDocumentFooters as $index => $xml) {
            $this->_objZip->addFromString($this->getFooterName($index), $xml);
        }

        //echo $this->_documentXML;

        // Close zip file
        if($this->_objZip->close() === false) {
            throw new Exception('Could not close zip file.');
        }
        $system_str=substr(PHP_OS, 0, 3) == 'WIN' ? 'GBK' : 'UTF-8';
        $strFilename=iconv('UTF-8',$system_str,$strFilename);
        rename($this->_tempFileName, $strFilename);
    }

    /**
     * Replace a block.
     *
     * @param string $blockname
     * @param string $replacement
     */
    //无效
    public function replaceBlock($blockname, $replacement)
    {
        ini_set('pcre.backtrack_limit', 999999999);
        $matches = array();
        preg_match(
            '/(<\?xml.*)(<w:p.*>\${' . $blockname . '}<\/w:.*?p>)(.*)(<w:p.*\${\/' . $blockname . '}<\/w:.*?p>)/is',
            $this->_documentXML,
            $matches
        );
        if (isset($matches[3])) {
            $this->_documentXML = str_replace(
                $matches[2] . $matches[3] . $matches[4],
                $replacement,
                $this->_documentXML
            );
        }
    }

    /**
     * Delete a block of text.
     *
     * @param string $blockname
     */
    //无效
    public function deleteBlock($blockname)
    {
        $this->replaceBlock($blockname, '');
    }

    /**
     * Clone a block.
     *
     * @param string $blockname
     * @param int $clones How many time the block should be cloned
     * @param bool $replace
     * @param bool $indexVariables If true, any variables inside the block will be indexed (postfixed with #1, #2, ...)
     * @param array $variableReplacements Array containing replacements for macros found inside the block to clone
     *
     * @return string|null
     */
    //无效
    public function cloneBlock($blockname, $clones = 1, $replace = true, $indexVariables = false, $variableReplacements = null)
    {
        ini_set('pcre.backtrack_limit', 999999999);
        $xmlBlock = null;
        preg_match(
            '/(<w:p.*>\${' . $blockname . '}<\/w:.*?p>)(.*)(<w:p.*\${\/' . $blockname . '}<\/w:.*?p>)/is',
            $this->tempDocumentMainPart,
            $matches
        );
        // print_r($matches);exit;
        if (isset($matches[2])) {
            $xmlBlock = $matches[2];
            $cloned = array();
            for ($i = 1; $i <= $clones; $i++) {
                $cloned[] = preg_replace('/\${(.*?)}/','${$1_'.$i.'}', $xmlBlock);
            }
            if ($replace) {
                $this->tempDocumentMainPart = str_replace(
                    $matches[1] . $matches[2] . $matches[3],
                    implode('', $cloned),
                    $this->tempDocumentMainPart
                );
            }
        }
        // print_r($xmlBlock);exit;
        return $xmlBlock;



        // ini_set('pcre.backtrack_limit', 999999999);
        // $xmlBlock = null;
        // $matches = array();
        // preg_match(
        //     '/(<\?xml.*)(<w:p\b.*>\${' . $blockname . '}<\/w:.*?p>)(.*)(<w:p\b.*\${\/' . $blockname . '}<\/w:.*?p>)/is',
        //     $this->tempDocumentMainPart,
        //     $matches
        // );
        // // preg_match(
        // //     '/(<\?xml.*)(<w:p.*>\${' . $blockname . '}<\/w:.*?p>)(.*)(<w:p.*\${\/' . $blockname . '}<\/w:.*?p>)/is',
        // //     $this->tempDocumentMainPart,
        // //     $matches
        // // );
        // print_r($matches);exit;
        // if (isset($matches[3])) {
        //     $xmlBlock = $matches[3];
        //     if ($indexVariables) {
        //         $cloned = $this->indexClonedVariables($clones, $xmlBlock);
        //     } elseif ($variableReplacements !== null && is_array($variableReplacements)) {
        //         $cloned = $this->replaceClonedVariables($variableReplacements, $xmlBlock);
        //     } else {
        //         $cloned = array();
        //         for ($i = 1; $i <= $clones; $i++) {
        //             $cloned[] = $xmlBlock;
        //         }
        //     }

        //     if ($replace) {
        //         $this->tempDocumentMainPart = str_replace(
        //             $matches[2] . $matches[3] . $matches[4],
        //             implode('', $cloned),
        //             $this->tempDocumentMainPart
        //         );
        //     }
        // }

        // return $xmlBlock;
    }

    /**
     * Replaces variable names in cloned
     * rows/blocks with indexed names
     *
     * @param int $count
     * @param string $xmlBlock
     *
     * @return string
     */
    protected function indexClonedVariables($count, $xmlBlock)
    {
        $results = array();
        for ($i = 1; $i <= $count; $i++) {
            $results[] = preg_replace('/\$\{(.*?)\}/', '\${\\1#' . $i . '}', $xmlBlock);
        }

        return $results;
    }

    /**
     * Raplaces variables with values from array, array keys are the variable names
     *
     * @param array $variableReplacements
     * @param string $xmlBlock
     *
     * @return string[]
     */
    protected function replaceClonedVariables($variableReplacements, $xmlBlock)
    {
        $results = array();
        foreach ($variableReplacements as $replacementArray) {
            $localXmlBlock = $xmlBlock;
            foreach ($replacementArray as $search => $replacement) {
                $localXmlBlock = $this->setValueForPart(self::ensureMacroCompleted($search), $replacement, $localXmlBlock, self::MAXIMUM_REPLACEMENTS_DEFAULT);
            }
            $results[] = $localXmlBlock;
        }

        return $results;
    }

    /**
     * Usually, the name of main part document will be 'document.xml'. However, some .docx files (possibly those from Office 365, experienced also on documents from Word Online created from blank templates) have file 'document22.xml' in their zip archive instead of 'document.xml'. This method searches content types file to correctly determine the file name.
     *
     * @return string
     */
    protected function getMainPartName()
    {
        $contentTypes = $this->_objZip->getFromName('[Content_Types].xml');

        $pattern = '~PartName="\/(word\/document.*?\.xml)" ContentType="application\/vnd\.openxmlformats-officedocument\.wordprocessingml\.document\.main\+xml"~';

        $matches = array();
        preg_match($pattern, $contentTypes, $matches);

        return array_key_exists(1, $matches) ? $matches[1] : 'word/document.xml';
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    protected function readPartWithRels($fileName)
    {
        $relsFileName = $this->getRelationsName($fileName);
        $partRelations = $this->_objZip->getFromName($relsFileName);
        if ($partRelations !== false) {
            $this->tempDocumentRelations[$fileName] = $partRelations;
        }

        return $this->fixBrokenMacros($this->_objZip->getFromName($fileName));
    }

    /**
     * Get the name of the relations file for document part.
     *
     * @param string $documentPartName
     *
     * @return string
     */
    protected function getRelationsName($documentPartName)
    {
        return 'word/_rels/' . pathinfo($documentPartName, PATHINFO_BASENAME) . '.rels';
    }

    /**
     * Finds parts of broken macros and sticks them together.
     * Macros, while being edited, could be implicitly broken by some of the word processors.
     *
     * @param string $documentPart The document part in XML representation
     *
     * @return string
     */
    // protected function fixBrokenMacros($documentPart)
    // {
    //     return preg_replace_callback(
    //         '/\$(?:\{|[^{$]*\>\{)[^}$]*\}/U',
    //         function ($match) {
    //             return strip_tags($match[0]);
    //         },
    //         $documentPart
    //     );
    // }
}
?>
