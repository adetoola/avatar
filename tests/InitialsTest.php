<?php

use Adetoola\Avatar\Initials;

use PHPUnit\Framework\TestCase;

class InitialsTest extends TestCase
{
    public function setUp()
    {
        $this->initials = new Initials();
    }

    public function testInitialsCanBeGenerated()
    {
        // Single name
        $this->initials->name('ßàßàfemi');
        $this->assertEquals('ßàß', $this->initials->getInitials());

        // Two names
        $this->initials->name('Sara Smithe');

        $this->assertEquals('SS', $this->initials->getInitials());

        // Initials

        $this->initials->name('AA');

        $this->assertEquals('AA', $this->initials->getInitials());

        // Three names

        $this->initials->name('Angelina Jolie Smith');

        $this->assertEquals('AJS', $this->initials->getInitials());

        // Email

        $this->initials->name('adetola.onasanya@gmail.com');

        $this->assertEquals('AO', $this->initials->getInitials());
    }

    public function testCanLimitInitials()
    {
        // One letter

        $this->initials->name('John Doe')->length(1);

        $this->assertEquals('J', $this->initials->getInitials());
        $this->assertEquals(1, strlen($this->initials->getInitials()));

        // Two letters
        $this->initials->name('John Doe')->length(2);

        $this->assertEquals('JD', $this->initials->getInitials());
        $this->assertEquals(2, strlen($this->initials->getInitials()));

        // Three letters
        $this->initials->name('John Doe Johnson')->length(3);

        $this->assertEquals('JDJ', $this->initials->getInitials());
        $this->assertEquals(3, strlen($this->initials->getInitials()));

        // Three letters with only two names
        $this->initials->name('John Doe')->length(3);

        $this->assertEquals('JD', $this->initials->getInitials());
        $this->assertEquals(2, strlen($this->initials->getInitials()));

        // Four letters with only two names
        $this->initials->name('John Doe')->length(4);

        $this->assertEquals('JD', $this->initials->getInitials());
        $this->assertEquals(2, strlen($this->initials->getInitials()));

        // Five letters with only one name of 4 letters
        // This is not possible, of cause, so it will end in 4 letters
        $this->initials->name('Tola')->length(5);

        $this->assertEquals('TOLA', $this->initials->getInitials());
        $this->assertEquals(4, strlen($this->initials->getInitials()));

        // Four letters with only one name of 4 letters
        $this->initials->name('Tola')->length(4);

        $this->assertEquals('TOLA', $this->initials->getInitials());
        $this->assertEquals(4, strlen($this->initials->getInitials()));

        // One letter from a one letter initial
        $this->initials->name('A')->length(1);

        $this->assertEquals('A', $this->initials->getInitials());
        $this->assertEquals(1, strlen($this->initials->getInitials()));
    }
}
