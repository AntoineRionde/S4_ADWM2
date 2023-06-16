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
    <title>Minipress</title>
    <meta charset=\"UTF-8\">
    <link rel=\"stylesheet\" href=\"/css/menu.css\";
</head>
<body>
";
        // line 9
        $this->loadTemplate("header.twig", "squelette.twig", 9)->display($context);
        // line 10
        echo "<div class=\"content\">
    ";
        // line 11
        $this->displayBlock('content', $context, $blocks);
        // line 12
        echo "</div>
<br />
<br />
<br />
<br />
";
        // line 17
        $this->loadTemplate("footer.twig", "squelette.twig", 17)->display($context);
        // line 18
        echo "</body>
</html>";
    }

    // line 11
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
        return array (  69 => 11,  64 => 18,  62 => 17,  55 => 12,  53 => 11,  50 => 10,  48 => 9,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "squelette.twig", "D:\\wamp64\\www\\SAE4_ADWM2\\minipress.core\\press.appli\\src\\templates\\squelette.twig");
    }
}
