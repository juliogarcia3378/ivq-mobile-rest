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
        $__internal_f54f078dfbae421fafa46980951388fcdde57b5a3a9a4e74973d1638e3879839 = $this->env->getExtension("native_profiler");
        $__internal_f54f078dfbae421fafa46980951388fcdde57b5a3a9a4e74973d1638e3879839->enter($__internal_f54f078dfbae421fafa46980951388fcdde57b5a3a9a4e74973d1638e3879839_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_f54f078dfbae421fafa46980951388fcdde57b5a3a9a4e74973d1638e3879839->leave($__internal_f54f078dfbae421fafa46980951388fcdde57b5a3a9a4e74973d1638e3879839_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_b60249ef78f2d379ef27c28771911212f4fc4aad6ce3c75a8c9fc20b069ce9b6 = $this->env->getExtension("native_profiler");
        $__internal_b60249ef78f2d379ef27c28771911212f4fc4aad6ce3c75a8c9fc20b069ce9b6->enter($__internal_b60249ef78f2d379ef27c28771911212f4fc4aad6ce3c75a8c9fc20b069ce9b6_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_b60249ef78f2d379ef27c28771911212f4fc4aad6ce3c75a8c9fc20b069ce9b6->leave($__internal_b60249ef78f2d379ef27c28771911212f4fc4aad6ce3c75a8c9fc20b069ce9b6_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_b66f8cbf5babf559d821615bdf0d02dd67d1c159da723618592a8608b0928ac0 = $this->env->getExtension("native_profiler");
        $__internal_b66f8cbf5babf559d821615bdf0d02dd67d1c159da723618592a8608b0928ac0->enter($__internal_b66f8cbf5babf559d821615bdf0d02dd67d1c159da723618592a8608b0928ac0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_b66f8cbf5babf559d821615bdf0d02dd67d1c159da723618592a8608b0928ac0->leave($__internal_b66f8cbf5babf559d821615bdf0d02dd67d1c159da723618592a8608b0928ac0_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_a5931921bf0dd5621e45e88ea3ea20d08d00a36a1d7546c50ddf8c33c8c461e3 = $this->env->getExtension("native_profiler");
        $__internal_a5931921bf0dd5621e45e88ea3ea20d08d00a36a1d7546c50ddf8c33c8c461e3->enter($__internal_a5931921bf0dd5621e45e88ea3ea20d08d00a36a1d7546c50ddf8c33c8c461e3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_a5931921bf0dd5621e45e88ea3ea20d08d00a36a1d7546c50ddf8c33c8c461e3->leave($__internal_a5931921bf0dd5621e45e88ea3ea20d08d00a36a1d7546c50ddf8c33c8c461e3_prof);

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
