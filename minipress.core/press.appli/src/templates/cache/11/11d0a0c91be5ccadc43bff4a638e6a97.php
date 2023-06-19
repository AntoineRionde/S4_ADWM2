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

/* createArticle.twig */
class __TwigTemplate_9aebe27e47c464da7034f250b9f43f0c extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "squelette.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("squelette.twig", "createArticle.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Création d'un article";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <form action=\"";
        echo twig_escape_filter($this->env, $this->env->getRuntime('Slim\Views\TwigRuntimeExtension')->urlFor("createArticlePost"), "html", null, true);
        echo "\" method=\"post\">

        <label for=\"titre\">Titre</label>
        <input type=\"text\" id=\"titre\" value=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "titre", [], "any", false, false, false, 9), "html", null, true);
        echo "\">

        <label for=\"auteur\">Auteur</label>
        <input type=\"text\" id=\"auteur\" value=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "auteur", [], "any", false, false, false, 12), "html", null, true);
        echo "\" >

        <label for=\"resume\" id=\"resume\">Résumé</label>
        <textarea id=\"resume\" name=\"resume\" rows=\"5\" cols=\"33\">";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "resume", [], "any", false, false, false, 15), "html", null, true);
        echo "</textarea>

        <label for=\"contenu\" id=\"contenu\">Contenu</label>
        <textarea id=\"contenu\" name=\"contenu\" rows=\"5\" cols=\"33\">";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "contenu", [], "any", false, false, false, 18), "html", null, true);
        echo "</textarea>

        <label for=\"url_image\">Image</label>    
        <input type=\"file\" id=\"url_image\" name=\"url_image\" value=\"";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "image", [], "any", false, false, false, 21), "html", null, true);
        echo "\">

        <label for=\"idCateg\">Id de la catégorie</label>
        <input type=\"number\" id=\"idCateg\" name=\"idCateg\" value=\"";
        // line 24
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["article"] ?? null), "idCateg", [], "any", false, false, false, 24), "html", null, true);
        echo "\">

        <input type=\"submit\" value=\"Envoyer\">

    </form>

";
    }

    public function getTemplateName()
    {
        return "createArticle.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 24,  89 => 21,  83 => 18,  77 => 15,  71 => 12,  65 => 9,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "createArticle.twig", "C:\\wamp64\\www\\SAE4_ADWM2\\minipress.core\\press.appli\\src\\templates\\createArticle.twig");
    }
}
