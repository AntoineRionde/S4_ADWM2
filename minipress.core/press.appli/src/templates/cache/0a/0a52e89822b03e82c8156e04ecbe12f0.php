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
class __TwigTemplate_a05b710a5c009f2550fe85b59a7cb86d extends Template
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
        <input type=\"text\" id=\"titre\" name=\"titre\">

        <label for=\"auteur\">Auteur</label>
        <input type=\"text\" id=\"auteur\" name=\"auteur\">

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

        <label for=\"image\">Image</label>
        <input type=\"file\" id=\"image\" name=\"image\" accept=\"image/png, image/jpeg\">

        <label for=\"cat-select\">Choississez une catégorie : </label>
        <select name=\"cats\" id=\"cat-select\">
            <option value=\"\">Choisir une catégorie</option>
            ";
        // line 26
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categories"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["cat"]) {
            // line 27
            echo "                <option value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["cat"], "id", [], "any", false, false, false, 27), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["cat"], "titre", [], "any", false, false, false, 27), "html", null, true);
            echo "</option>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cat'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        echo "        </select>

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
        return array (  103 => 29,  92 => 27,  88 => 26,  77 => 18,  71 => 15,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "createArticle.twig", "D:\\wamp64\\www\\SAE4_ADWM2\\minipress.core\\press.appli\\src\\templates\\createArticle.twig");
    }
}
