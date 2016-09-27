<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_b4fe69f0c286466cd9f7bb705c98d35eb7f2e60c26a282b10223d7c3e6d7470b extends Twig_Template
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
        $__internal_ad048c96fbf8f6cd3eea883d82d6e89fc1a580d597107d6db15bf072be386772 = $this->env->getExtension("native_profiler");
        $__internal_ad048c96fbf8f6cd3eea883d82d6e89fc1a580d597107d6db15bf072be386772->enter($__internal_ad048c96fbf8f6cd3eea883d82d6e89fc1a580d597107d6db15bf072be386772_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ad048c96fbf8f6cd3eea883d82d6e89fc1a580d597107d6db15bf072be386772->leave($__internal_ad048c96fbf8f6cd3eea883d82d6e89fc1a580d597107d6db15bf072be386772_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_e9ec25476ae79942559b70ecb9fcb0919191e7b2ac80ba882d6bf0b9c644db70 = $this->env->getExtension("native_profiler");
        $__internal_e9ec25476ae79942559b70ecb9fcb0919191e7b2ac80ba882d6bf0b9c644db70->enter($__internal_e9ec25476ae79942559b70ecb9fcb0919191e7b2ac80ba882d6bf0b9c644db70_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_e9ec25476ae79942559b70ecb9fcb0919191e7b2ac80ba882d6bf0b9c644db70->leave($__internal_e9ec25476ae79942559b70ecb9fcb0919191e7b2ac80ba882d6bf0b9c644db70_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_951fdd0ee5c0fad79479238c0247c79562cb0cdc4e86da56e9a6d6a740e3bcb8 = $this->env->getExtension("native_profiler");
        $__internal_951fdd0ee5c0fad79479238c0247c79562cb0cdc4e86da56e9a6d6a740e3bcb8->enter($__internal_951fdd0ee5c0fad79479238c0247c79562cb0cdc4e86da56e9a6d6a740e3bcb8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_951fdd0ee5c0fad79479238c0247c79562cb0cdc4e86da56e9a6d6a740e3bcb8->leave($__internal_951fdd0ee5c0fad79479238c0247c79562cb0cdc4e86da56e9a6d6a740e3bcb8_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_59945eedf5e442e7a481f43fd0dfeb5beb7b7907adc756fe7675c0ac30edb615 = $this->env->getExtension("native_profiler");
        $__internal_59945eedf5e442e7a481f43fd0dfeb5beb7b7907adc756fe7675c0ac30edb615->enter($__internal_59945eedf5e442e7a481f43fd0dfeb5beb7b7907adc756fe7675c0ac30edb615_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_59945eedf5e442e7a481f43fd0dfeb5beb7b7907adc756fe7675c0ac30edb615->leave($__internal_59945eedf5e442e7a481f43fd0dfeb5beb7b7907adc756fe7675c0ac30edb615_prof);

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

    public function getSource()
    {
        return "{% extends '@Twig/layout.html.twig' %}

{% block head %}
    <link href=\"{{ absolute_url(asset('bundles/framework/css/exception.css')) }}\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
{% endblock %}

{% block title %}
    {{ exception.message }} ({{ status_code }} {{ status_text }})
{% endblock %}

{% block body %}
    {% include '@Twig/Exception/exception.html.twig' %}
{% endblock %}
";
    }
}
