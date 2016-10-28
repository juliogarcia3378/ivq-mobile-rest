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
        $__internal_212acd04361ebdf5dbda7a3b651b068f56557f93ff762ac847d1e8ca54f55faf = $this->env->getExtension("native_profiler");
        $__internal_212acd04361ebdf5dbda7a3b651b068f56557f93ff762ac847d1e8ca54f55faf->enter($__internal_212acd04361ebdf5dbda7a3b651b068f56557f93ff762ac847d1e8ca54f55faf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_212acd04361ebdf5dbda7a3b651b068f56557f93ff762ac847d1e8ca54f55faf->leave($__internal_212acd04361ebdf5dbda7a3b651b068f56557f93ff762ac847d1e8ca54f55faf_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_67c83b91320edb0022ce70d6f5afc1ad3b309c5e7f66aa1caece53b1842d1a15 = $this->env->getExtension("native_profiler");
        $__internal_67c83b91320edb0022ce70d6f5afc1ad3b309c5e7f66aa1caece53b1842d1a15->enter($__internal_67c83b91320edb0022ce70d6f5afc1ad3b309c5e7f66aa1caece53b1842d1a15_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_67c83b91320edb0022ce70d6f5afc1ad3b309c5e7f66aa1caece53b1842d1a15->leave($__internal_67c83b91320edb0022ce70d6f5afc1ad3b309c5e7f66aa1caece53b1842d1a15_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_2c27806fe8d649524aab0e0e78293deb2187243ead6d0b252b0d69b7dc71b5ed = $this->env->getExtension("native_profiler");
        $__internal_2c27806fe8d649524aab0e0e78293deb2187243ead6d0b252b0d69b7dc71b5ed->enter($__internal_2c27806fe8d649524aab0e0e78293deb2187243ead6d0b252b0d69b7dc71b5ed_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_2c27806fe8d649524aab0e0e78293deb2187243ead6d0b252b0d69b7dc71b5ed->leave($__internal_2c27806fe8d649524aab0e0e78293deb2187243ead6d0b252b0d69b7dc71b5ed_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_13f2988e3559818f6ffad1aa608ff468ae0359d28dda76ee3ec6bafe7361b2ac = $this->env->getExtension("native_profiler");
        $__internal_13f2988e3559818f6ffad1aa608ff468ae0359d28dda76ee3ec6bafe7361b2ac->enter($__internal_13f2988e3559818f6ffad1aa608ff468ae0359d28dda76ee3ec6bafe7361b2ac_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_13f2988e3559818f6ffad1aa608ff468ae0359d28dda76ee3ec6bafe7361b2ac->leave($__internal_13f2988e3559818f6ffad1aa608ff468ae0359d28dda76ee3ec6bafe7361b2ac_prof);

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
