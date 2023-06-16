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

/* header.twig */
class __TwigTemplate_cf82db73b2a6158f0b285f112250a5f7 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<header>
    <div class=\"nom\">
        <h1>MiniPress</h1>
    </div>
    <div class=\"nav\">
        <ul>
            <li><a href=\"";
        // line 7
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("home"), "html", null, true);
        echo "\">Home</a></li>
            <li><a href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("categories"), "html", null, true);
        echo "\">Categories</a></li>
            <li><a href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("articles"), "html", null, true);
        echo "\">Articles</a></li>
             <li><a href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("createCategorie"), "html", null, true);
        echo "\">Créer une catégorie</a></li>
            <li><a href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("createArticle"), "html", null, true);
        echo "\">Créer un article</a></li>
        </ul>
    </div>
</header>";
    }

    public function getTemplateName()
    {
        return "header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 11,  57 => 10,  53 => 9,  49 => 8,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "header.twig", "D:\\wamp64\\www\\SAE4_ADWM2\\minipress.core\\press.appli\\src\\templates\\header.twig");
    }
}
