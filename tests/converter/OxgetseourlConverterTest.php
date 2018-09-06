<?php

namespace sankar\ST\Tests\Converter;

use toTwig\Converter\OxgetseourlConverter;

/**
 * Class OxgetseourlConverterTest
 *
 * @author Tomasz Kowalewski (t.kowalewski@createit.pl)
 */
class OxgetseourlConverterTest extends AbstractConverterTest
{
    /** @var OxgetseourlConverter */
    protected $converter;

    public function setUp()
    {
        $this->converter = new OxgetseourlConverter();
    }

    /**
     * @covers \toTwig\Converter\OxgetseourlConverter::convert
     *
     * @dataProvider Provider
     *
     * @param $smarty
     * @param $twig
     */
    public function testThatAssignIsConverted($smarty, $twig)
    {
        // Test the above cases
        $this->assertSame($twig,
            $this->converter->convert($this->getFileMock(), $smarty)
        );
    }

    /**
     * @return array
     */
    public function Provider()
    {
        return [
            // Example from OXID
            [
                "[{oxgetseourl ident=\$oViewConf->getSelfLink()|cat:\"cl=basket\"}]",
                "{{ oxgetseourl({ ident: oViewConf.getSelfLink()|cat(\"cl=basket\") }) }}"
            ],
            // Example from OXID
            [
                "[{oxgetseourl ident=\$oViewConf->getSelfLink()|cat:\"cl=account\" params=\"anid=`\$oDetailsProduct->oxarticles__oxnid->value`\"|cat:\"&amp;sourcecl=\"|cat:\$oViewConf->getTopActiveClassName()|cat:\$oViewConf->getNavUrlParams()}]",
                "{{ oxgetseourl({ ident: oViewConf.getSelfLink()|cat(\"cl=account\"), params: \"anid=`\$oDetailsProduct.oxarticles__oxnid.value`\"|cat(\"&amp;sourcecl=\")|cat(oViewConf.getTopActiveClassName())|cat(oViewConf.getNavUrlParams()) }) }}"
            ],
            // With spaces
            [
                "[{ oxgetseourl ident=\"basket\"}]",
                "{{ oxgetseourl({ ident: \"basket\" }) }}"
            ],
        ];
    }

    /**
     * @covers \toTwig\Converter\OxgetseourlConverter::getName
     */
    public function testThatHaveExpectedName()
    {
        $this->assertEquals('oxgetseourl', $this->converter->getName());
    }

    /**
     * @covers \toTwig\Converter\OxgetseourlConverter::getDescription
     */
    public function testThatHaveDescription()
    {
        $this->assertNotEmpty($this->converter->getDescription());
    }
}