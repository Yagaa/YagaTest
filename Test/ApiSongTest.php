<?php
define("CONF_PATH", __DIR__."/../Conf");
define("MODEL_PATH", __DIR__."/../Model");
define("API_PATH", __DIR__."/../Api");

require MODEL_PATH."/Song.php";

class ApiSongTest extends PHPUnit_Framework_TestCase
{
    
    public function testGetSong()
    {
        $modelSong = new Model_Song();
        $songs = $modelSong->GetSong(1);
        $this->assertInternalType('array',$songs);
    }
    
}
