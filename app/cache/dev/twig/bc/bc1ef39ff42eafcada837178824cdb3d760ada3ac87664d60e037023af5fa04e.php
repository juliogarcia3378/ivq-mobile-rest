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
        $__internal_27a025469b56b67894ca2ebd43254ee61a78fdb727fd9d0466565ba30d7d0227 = $this->env->getExtension("native_profiler");
        $__internal_27a025469b56b67894ca2ebd43254ee61a78fdb727fd9d0466565ba30d7d0227->enter($__internal_27a025469b56b67894ca2ebd43254ee61a78fdb727fd9d0466565ba30d7d0227_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_27a025469b56b67894ca2ebd43254ee61a78fdb727fd9d0466565ba30d7d0227->leave($__internal_27a025469b56b67894ca2ebd43254ee61a78fdb727fd9d0466565ba30d7d0227_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_9aec3beea93c86b1587ea9159dfae1addcc1395885ff5af47897bc9ae3116d91 = $this->env->getExtension("native_profiler");
        $__internal_9aec3beea93c86b1587ea9159dfae1addcc1395885ff5af47897bc9ae3116d91->enter($__internal_9aec3beea93c86b1587ea9159dfae1addcc1395885ff5af47897bc9ae3116d91_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_9aec3beea93c86b1587ea9159dfae1addcc1395885ff5af47897bc9ae3116d91->leave($__internal_9aec3beea93c86b1587ea9159dfae1addcc1395885ff5af47897bc9ae3116d91_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_20f473a8c19bf8ab383b4af405d407a28231c8e42d8e21d319a2a03742ce18c0 = $this->env->getExtension("native_profiler");
        $__internal_20f473a8c19bf8ab383b4af405d407a28231c8e42d8e21d319a2a03742ce18c0->enter($__internal_20f473a8c19bf8ab383b4af405d407a28231c8e42d8e21d319a2a03742ce18c0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_20f473a8c19bf8ab383b4af405d407a28231c8e42d8e21d319a2a03742ce18c0->leave($__internal_20f473a8c19bf8ab383b4af405d407a28231c8e42d8e21d319a2a03742ce18c0_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_d9118f1e78deba312c53fba1629f548844d2528b5d0c8cdb77e86ae7e93e8533 = $this->env->getExtension("native_profiler");
        $__internal_d9118f1e78deba312c53fba1629f548844d2528b5d0c8cdb77e86ae7e93e8533->enter($__internal_d9118f1e78deba312c53fba1629f548844d2528b5d0c8cdb77e86ae7e93e8533_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_d9118f1e78deba312c53fba1629f548844d2528b5d0c8cdb77e86ae7e93e8533->leave($__internal_d9118f1e78deba312c53fba1629f548844d2528b5d0c8cdb77e86ae7e93e8533_prof);

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
