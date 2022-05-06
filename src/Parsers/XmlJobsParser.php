<?php
    namespace Parsers;

    abstract class XmlJobsParser extends Parser  implements Parserable{

        public function getData()
        {
            return simplexml_load_file($this->getFilename(), 'SimpleXMLElement', LIBXML_NOCDATA);
        }
    }

?>