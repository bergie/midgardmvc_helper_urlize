<?php
/**
 * @package midgardmvc_helper_urlize
 * @author The Midgard Project, http://www.midgard-project.org
 * @copyright The Midgard Project, http://www.midgard-project.org
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */

/**
 * Unit tests for the URL generator
 *
 * @package midgardmvc_helper_urlize
 */
class midgardmvc_helper_urlize_tests_interface extends PHPUnit_FrameWork_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function test_empty()
    {
        $url = midgardmvc_helper_urlize::string('');
    }

    public function test_clean()
    {
        $string = 'hello_midgard';
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals($string, $url);

        $string2 = 'hello midgard';
        $url = midgardmvc_helper_urlize::string($string2);
        $this->assertEquals($string, $url);
    }

    public function test_scandinavian()
    {
        $string = 'älä lyö ääliö ööliä läikkyy';
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('ala_lyo_aalio_oolia_laikkyy', $url);
    }

    public function test_russian()
    {
        $string = 'Контакты'; // Kontakty
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('kontakty', $url);
    }

    public function test_korean()
    {
        $this->markTestSkipped();
        $string = '해동검도';  // Haedong Kumdo
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('haedong_kumdo', $url);
    }

    public function test_hiragana()
    {
        $this->markTestSkipped();
        $string = 'ひらがな';
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('hiragana', $url);
    }

    public function test_georgian()
    {
        $this->markTestSkipped();
        $string = 'საქართველო';
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('sakartvelo', $url);
    }

    public function test_arabic()
    {
        $string = 'العربي'; // al-ʿarabiyyah
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('l_rby', $url);

        $string = 'عرب'; // ʿarabī
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('rb', $url);
    }

    public function test_hebrew()
    {
        $string = 'עִבְרִית'; // Ivrit
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('ib_riyt', $url);
    }

    public function test_turkish()
    {
        $string = 'Sanırım hepimiz aynı şeyi düşünüyoruz.';
        $url = midgardmvc_helper_urlize::string($string);
        $this->assertEquals('sanirim_hepimiz_ayni_seyi_dusunuyoruz', $url);
    }

    public function test_replacer()
    {
        $string = 'test, she said';
        $url = midgardmvc_helper_urlize::string($string, '-');
        $this->assertEquals($url, 'test-she-said');
    }
    
    public function test_double_convert()
    {
        $string = 'foo & bar';
        $clean1 = midgardmvc_helper_urlize::string($string);
        $clean2 = midgardmvc_helper_urlize::string($clean1);
        $this->assertEquals($clean1, $clean2);
    }
}
