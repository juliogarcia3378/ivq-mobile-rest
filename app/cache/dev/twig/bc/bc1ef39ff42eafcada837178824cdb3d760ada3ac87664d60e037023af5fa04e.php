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
        $__internal_f508bb016f00ed77f9442eb37e66b1fe46790f3981c9b4c5daab8002cb5f1ea6 = $this->env->getExtension("native_profiler");
        $__internal_f508bb016f00ed77f9442eb37e66b1fe46790f3981c9b4c5daab8002cb5f1ea6->enter($__internal_f508bb016f00ed77f9442eb37e66b1fe46790f3981c9b4c5daab8002cb5f1ea6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f508bb016f00ed77f9442eb37e66b1fe46790f3981c9b4c5daab8002cb5f1ea6->leave($__internal_f508bb016f00ed77f9442eb37e66b1fe46790f3981c9b4c5daab8002cb5f1ea6_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_f0b68c3a508beed2102ec431b0c48222d023fb59a017b3e29b32929bf8f643a7 = $this->env->getExtension("native_profiler");
        $__internal_f0b68c3a508beed2102ec431b0c48222d023fb59a017b3e29b32929bf8f643a7->enter($__internal_f0b68c3a508beed2102ec431b0c48222d023fb59a017b3e29b32929bf8f643a7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_f0b68c3a508beed2102ec431b0c48222d023fb59a017b3e29b32929bf8f643a7->leave($__internal_f0b68c3a508beed2102ec431b0c48222d023fb59a017b3e29b32929bf8f643a7_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_24b31bf0307c1da6db0d50ea2ce6053387d30cb2fae0469e5608f04234379067 = $this->env->getExtension("native_profiler");
        $__internal_24b31bf0307c1da6db0d50ea2ce6053387d30cb2fae0469e5608f04234379067->enter($__internal_24b31bf0307c1da6db0d50ea2ce6053387d30cb2fae0469e5608f04234379067_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_24b31bf0307c1da6db0d50ea2ce6053387d30cb2fae0469e5608f04234379067->leave($__internal_24b31bf0307c1da6db0d50ea2ce6053387d30cb2fae0469e5608f04234379067_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_cef666d88394e11898fc124fc5f8bdaa9a4b3f6a49b1819e580143a40e6776f8 = $this->env->getExtension("native_profiler");
        $__internal_cef666d88394e11898fc124fc5f8bdaa9a4b3f6a49b1819e580143a40e6776f8->enter($__internal_cef666d88394e11898fc124fc5f8bdaa9a4b3f6a49b1819e580143a40e6776f8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_cef666d88394e11898fc124fc5f8bdaa9a4b3f6a49b1819e580143a40e6776f8->leave($__internal_cef666d88394e11898fc124fc5f8bdaa9a4b3f6a49b1819e580143a40e6776f8_prof);

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
