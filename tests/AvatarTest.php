<?php

use Adetoola\Avatar\Avatar;

use PHPUnit\Framework\TestCase;

class AvatarTest extends TestCase
{
    public function setUp()
    {
        $this->avatar = new Avatar();
    }

    public function testNameCanBeSet()
    {
        $this->avatar->name('John Doe');

        $this->assertEquals('JD', $this->avatar->getInitials());
    }

    public function testSizeCanBeSet()
    {
        $this->avatar->size(720);

        $this->assertEquals(720, $this->avatar->getSize());
    }

    /**
     * @expectedException Adetoola\Avatar\Exception\AvatarException
     */
    public function testSizeCanNotBeNegative()
    {
        $this->avatar->size(-720);
    }

    public function testBackgroundCanBeSet_With_String()
    {
        // single color is given
        $this->avatar->background('#fff');

        $this->assertEquals('#fff', $this->avatar->getBackground());
    }

    public function testBackgroundCanBeSet_With_Array()
    {
        // array of colors is given
        $this->avatar->background(['#fff', '#ccc', '#eee']);

        $this->assertContains($this->avatar->getBackground(), ['#fff', '#ccc', '#eee']);
    }

    public function testBackgroundCanBeSet_With_Null()
    {
        // null is given
        $this->avatar->background();
        $this->assertRegExp("/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/", $this->avatar->getBackground());
    }

    public function testRoundedCanBeSet()
    {
        // false - default
        $this->avatar->rounded();
        $this->assertFalse($this->avatar->getRounded());

        //true
        $this->avatar->rounded();
        $this->assertTrue(true, $this->avatar->getRounded(true));
    }

    public function testColorCanBeSet()
    {
        $this->avatar->color('#eee');
         $this->assertEquals('#eee', $this->avatar->getColor());
    }

    public function testFontCanBeSet()
    {
        $this->avatar->font('roboto.ttf');
         $this->assertEquals('roboto.ttf', $this->avatar->getFont());
    }

    public function testFontSizeCanBeSet()
    {
        $this->avatar->fontSize(0.667);
         $this->assertEquals(0.67, $this->avatar->getFontSize());
    }

    public function testReturnsImageObject()
    {
        $image = $this->avatar->generate();

        $this->assertEquals('Image', class_basename($image));
    }

    public function testStreamIsReadable()
    {
        $this->assertTrue($this->avatar->generate()->stream()->isReadable());
    }

    public function testImageCanBeEncoded()
    {
        $encoded = (string) $this->avatar;
        $this->markTestIncomplete();
    }

    public function testImageRoundedWasSet()
    {
        $this->avatar->rounded(true);

        $image = $this->avatar->rounded()->generate();
        $this->assertEquals('Image', class_basename($image));
    }

    public function testImageSizeWasSet()
    {
        $this->avatar->size(360);

        $this->assertEquals(360, $this->avatar->generate()->getWidth());
        $this->assertEquals(360, $this->avatar->generate()->getHeight());
    }

    public function testNameWasSet()
    {
        $this->avatar->name('Babafemi David');

        $fs = $this->avatar->generate()->save('image.png');
    }

}
