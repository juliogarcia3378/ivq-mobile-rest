<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_066c688afd93b057ae44a777920ca8572ed093206d4151cedff603dedce15f9a extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_da7624e430e48e549a7537b6ae6432854da495e7c0ea128b2884c380a4eda575 = $this->env->getExtension("native_profiler");
        $__internal_da7624e430e48e549a7537b6ae6432854da495e7c0ea128b2884c380a4eda575->enter($__internal_da7624e430e48e549a7537b6ae6432854da495e7c0ea128b2884c380a4eda575_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_da7624e430e48e549a7537b6ae6432854da495e7c0ea128b2884c380a4eda575->leave($__internal_da7624e430e48e549a7537b6ae6432854da495e7c0ea128b2884c380a4eda575_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_0ce2d782bf65f0feb760de94db78fad67aa44aedde71531251e0b7e70f9a80fc = $this->env->getExtension("native_profiler");
        $__internal_0ce2d782bf65f0feb760de94db78fad67aa44aedde71531251e0b7e70f9a80fc->enter($__internal_0ce2d782bf65f0feb760de94db78fad67aa44aedde71531251e0b7e70f9a80fc_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_0ce2d782bf65f0feb760de94db78fad67aa44aedde71531251e0b7e70f9a80fc->leave($__internal_0ce2d782bf65f0feb760de94db78fad67aa44aedde71531251e0b7e70f9a80fc_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_55dc35d85bd7870ac58158ea1922365e940751d6c6320c0715dcd6d216ddc62e = $this->env->getExtension("native_profiler");
        $__internal_55dc35d85bd7870ac58158ea1922365e940751d6c6320c0715dcd6d216ddc62e->enter($__internal_55dc35d85bd7870ac58158ea1922365e940751d6c6320c0715dcd6d216ddc62e_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_55dc35d85bd7870ac58158ea1922365e940751d6c6320c0715dcd6d216ddc62e->leave($__internal_55dc35d85bd7870ac58158ea1922365e940751d6c6320c0715dcd6d216ddc62e_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_26c3c8a55e7a6526d596fc8450ed9e1c9b2ef4b85a4b5b9223bfef8bf04be191 = $this->env->getExtension("native_profiler");
        $__internal_26c3c8a55e7a6526d596fc8450ed9e1c9b2ef4b85a4b5b9223bfef8bf04be191->enter($__internal_26c3c8a55e7a6526d596fc8450ed9e1c9b2ef4b85a4b5b9223bfef8bf04be191_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_26c3c8a55e7a6526d596fc8450ed9e1c9b2ef4b85a4b5b9223bfef8bf04be191->leave($__internal_26c3c8a55e7a6526d596fc8450ed9e1c9b2ef4b85a4b5b9223bfef8bf04be191_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
