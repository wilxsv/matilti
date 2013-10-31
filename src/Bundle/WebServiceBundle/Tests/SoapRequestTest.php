<?php
/*
 * This file is part of the WebServiceBundle.
 *
 * (c) Christian Kerl <christian-kerl@web.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\WebServiceBundle\Tests;

use Bundle\WebServiceBundle\Soap\SoapRequest;

/**
 * UnitTest for \Bundle\WebServiceBundle\Soap\SoapRequest.
 *
 * @author Christian Kerl <christian-kerl@web.de>
 */
class SoapRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testMtomMessage()
    {
        $content = $this->loadRequestContentFixture('mtom/simple.txt');

        $request = new SoapRequest($content);
        $request->server->set('CONTENT_TYPE', 'multipart/related; type="application/xop+xml";start="<http://tempuri.org/0>";boundary="uuid:0ca0e16e-feb1-426c-97d8-c4508ada5e82+id=7";start-info="application/soap+xml"');

        $message = $request->getSoapMessage();

        $this->assertEquals(735, strlen(trim($message)));
        $this->assertEquals(1, count($request->getSoapAttachments()));

        $attachment = $request->getSoapAttachments()->get('http://tempuri.org/1/632618206527087310');

        $this->assertNotNull($attachment);
        $this->assertEquals('application/octet-stream', $attachment->getType());
        $this->assertEquals(767, strlen(trim($attachment->getContent())));
    }

    private function loadRequestContentFixture($name)
    {
        return file_get_contents(__DIR__ . '/fixtures/' . $name);
    }
}
