<?php

// tree structure
// tree structure of components (nodes in tree) and composite object (root and folders in tree)

interface RenderableComponent
{
    public function render(): string;
}

class TextElement implements RenderableComponent // node in tree
{
    private $text = "";

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function render(): string
    {
        return $this->text;
    }
}

class InputElement implements RenderableComponent // node in tree
{
    public function render(): string
    {
        return '<input type="text" />';
    }
}

class FormComposite implements RenderableComponent // root or folder in tree
{

    private $elements = [];

    public function render(): string
    {
        $formCode = '<form>';

        foreach ($this->elements as $element) {
            $formCode .= $element->render();
        }

        $formCode .= '</form>';

        return $formCode;
    }

    public function addElement(RenderableComponent $element)
    {
        $this->elements[] = $element;
    }
}

$form = new FormComposite(); // root form
$form->addElement(new TextElement('Email:'));
$form->addElement(new InputElement());

$embed = new FormComposite(); // form as folder in tree
$embed->addElement(new TextElement('Password:'));
$embed->addElement(new InputElement());

$form->addElement($embed);

echo $form->render(); // get result 