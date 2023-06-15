<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* squelette.twig */
class __TwigTemplate_900da9347588e65e93926ef91030a463 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <title>Home - Minipress</title>
    <meta charset=\"UTF-8\">
</head>
<body>
";
        // line 8
        $this->loadTemplate("header.twig", "squelette.twig", 8)->display($context);
        // line 9
        echo "<div class=\"content\">
    ";
        // line 10
        $this->displayBlock('content', $context, $blocks);
        // line 11
        echo "</div>
";
        // line 12
        $this->loadTemplate("footer.twig", "squelette.twig", 12)->display($context);
        // line 13
        echo "</body>
</html>";
    }

    // line 10
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo " ";
    }

    public function getTemplateName()
    {
        return "squelette.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  64 => 10,  59 => 13,  57 => 12,  54 => 11,  52 => 10,  49 => 9,  47 => 8,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "squelette.twig", "D:\\wamp64\\www\\SAE4_ADWM2\\minipress.core\\press.appli\\src\\templates\\squelette.twig");
    }
}
