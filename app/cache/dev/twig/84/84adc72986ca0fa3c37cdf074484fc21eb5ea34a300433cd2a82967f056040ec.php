<?php

/* base.html.twig */
class __TwigTemplate_a1c7501337e0380b0de6b8dfa4a449a1d9f82fb27aa03782cbdf2de5a0c18644 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_9324084e590f620502008b5375e55367208b3bcecd440e3449421755f8ddd3b3 = $this->env->getExtension("native_profiler");
        $__internal_9324084e590f620502008b5375e55367208b3bcecd440e3449421755f8ddd3b3->enter($__internal_9324084e590f620502008b5375e55367208b3bcecd440e3449421755f8ddd3b3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 6
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 7
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
    </head>
    <body>
        ";
        // line 10
        $this->displayBlock('body', $context, $blocks);
        // line 11
        echo "        ";
        $this->displayBlock('javascripts', $context, $blocks);
        // line 12
        echo "    </body>
</html>
";
        
        $__internal_9324084e590f620502008b5375e55367208b3bcecd440e3449421755f8ddd3b3->leave($__internal_9324084e590f620502008b5375e55367208b3bcecd440e3449421755f8ddd3b3_prof);

    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        $__internal_bd462acb47463c3bd532fd5c20a4adb7af9e6197aec0c9f193780f71093c776c = $this->env->getExtension("native_profiler");
        $__internal_bd462acb47463c3bd532fd5c20a4adb7af9e6197aec0c9f193780f71093c776c->enter($__internal_bd462acb47463c3bd532fd5c20a4adb7af9e6197aec0c9f193780f71093c776c_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        echo "Welcome!";
        
        $__internal_bd462acb47463c3bd532fd5c20a4adb7af9e6197aec0c9f193780f71093c776c->leave($__internal_bd462acb47463c3bd532fd5c20a4adb7af9e6197aec0c9f193780f71093c776c_prof);

    }

    // line 6
    public function block_stylesheets($context, array $blocks = array())
    {
        $__internal_5de1e5084ec7176771db21f309cb7b905ab9801fbf1c8f100933a8bef1f52d1b = $this->env->getExtension("native_profiler");
        $__internal_5de1e5084ec7176771db21f309cb7b905ab9801fbf1c8f100933a8bef1f52d1b->enter($__internal_5de1e5084ec7176771db21f309cb7b905ab9801fbf1c8f100933a8bef1f52d1b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_5de1e5084ec7176771db21f309cb7b905ab9801fbf1c8f100933a8bef1f52d1b->leave($__internal_5de1e5084ec7176771db21f309cb7b905ab9801fbf1c8f100933a8bef1f52d1b_prof);

    }

    // line 10
    public function block_body($context, array $blocks = array())
    {
        $__internal_c53cbd790a42f8a6a2983a40995deadc63e78b5206f4a58e86222e5a9ebf2248 = $this->env->getExtension("native_profiler");
        $__internal_c53cbd790a42f8a6a2983a40995deadc63e78b5206f4a58e86222e5a9ebf2248->enter($__internal_c53cbd790a42f8a6a2983a40995deadc63e78b5206f4a58e86222e5a9ebf2248_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        
        $__internal_c53cbd790a42f8a6a2983a40995deadc63e78b5206f4a58e86222e5a9ebf2248->leave($__internal_c53cbd790a42f8a6a2983a40995deadc63e78b5206f4a58e86222e5a9ebf2248_prof);

    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        $__internal_b0212528a1a968c9fc4af810fab48ee53b4a89fc287e9016500aa6986a07aa9e = $this->env->getExtension("native_profiler");
        $__internal_b0212528a1a968c9fc4af810fab48ee53b4a89fc287e9016500aa6986a07aa9e->enter($__internal_b0212528a1a968c9fc4af810fab48ee53b4a89fc287e9016500aa6986a07aa9e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "javascripts"));

        
        $__internal_b0212528a1a968c9fc4af810fab48ee53b4a89fc287e9016500aa6986a07aa9e->leave($__internal_b0212528a1a968c9fc4af810fab48ee53b4a89fc287e9016500aa6986a07aa9e_prof);

    }

    public function getTemplateName()
    {
        return "base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 11,  82 => 10,  71 => 6,  59 => 5,  50 => 12,  47 => 11,  45 => 10,  38 => 7,  36 => 6,  32 => 5,  26 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html>*/
/*     <head>*/
/*         <meta charset="UTF-8" />*/
/*         <title>{% block title %}Welcome!{% endblock %}</title>*/
/*         {% block stylesheets %}{% endblock %}*/
/*         <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />*/
/*     </head>*/
/*     <body>*/
/*         {% block body %}{% endblock %}*/
/*         {% block javascripts %}{% endblock %}*/
/*     </body>*/
/* </html>*/
/* */
