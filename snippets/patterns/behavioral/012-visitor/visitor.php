<?php

/*
    Make objet extendable by new action.
    This example add xml export to tree of nodes.
    Visitor dont check node type but node call coresponding function from visitor for self export (Double Dispatch)

    New type of TreeElement node can be create without add "if" and type check to export function.
*/

interface VisitorComponent
{
    public function accept(TreeElementVisitor $visitor): void;
}

class TreeElement
{

}

class Node extends TreeElement implements VisitorComponent
{
    private $name = "";

    private $childs = [];

    public function __construct($name){
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }    

    public function childCount() {
        return count($this->childs);
    }

    public function getChild($i) {
        return $this->childs[$i];
    }

    public function addChild(TreeElement $child){
        $this->childs[] = $child;
    }   

    public function accept(TreeElementVisitor $visitor): void // call corresponding function for export in visitor for this type
    {
        $visitor->visitNode($this);
    }
}

class TextNode extends TreeElement implements VisitorComponent
{
    private $text = "";

    public function __construct($text){
        $this->text = $text;
    }

    public function getText() {
        return $this->text;
    }

    public function setText($text){
        $this->text = $text;
    }       

    public function accept(TreeElementVisitor $visitor): void // call corresponding function for export in visitor for this type
    {
        $visitor->visitTextNode($this);
    }
}

interface TreeElementVisitor
{
    public function visitNode(Node $element): void; // each type of elment has own method for export
    public function visitTextNode(TextNode $element): void;
}

class ExportToXMLVisitor implements TreeElementVisitor // contain all export logic
{
    private $xml = "";

    public function getXML() {
        return $this->xml;
    }

    public function visitNode(Node $element) : void // each type of elment has own method for export
    {
        $this->xml .= "<".$element->getName().">";

        for($i = 0; $i< $element->childCount(); $i++){
            $element->getChild($i)->accept($this); // Double Dispatch -> node call coresponding function for export from visitor (no check for node type is needed)
        }

        $this->xml .= "</".$element->getName().">";
    }

    public function visitTextNode(TextNode $element) : void // each type of elment has own method for export
    {
        $this->xml .= $element->getText();
    }
}

$nodeA = new Node("a");

$nodeB = new Node("b");
$nodeA->addChild($nodeB);
$text1 = new TextNode('text1');
$nodeB->addChild($text1);

$nodeC = new Node("c");
$nodeA->addChild($nodeC);

$nodeD = new Node("d");
$nodeC->addChild($nodeD);

$text2 = new TextNode('text2');
$nodeD->addChild($text2);

$visitor = new ExportToXMLVisitor;
$nodeA->accept($visitor);
echo $visitor->getXML(); // <a><b>text1</b><c><d>text2</d></c></a>
