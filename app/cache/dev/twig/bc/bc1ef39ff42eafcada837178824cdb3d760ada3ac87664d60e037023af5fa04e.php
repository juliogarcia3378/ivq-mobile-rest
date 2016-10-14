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
        $__internal_cdfdab7bcb0ebf589c3b8e457fa62f76280e26d583f257015e0fc6b76bf9f413 = $this->env->getExtension("native_profiler");
        $__internal_cdfdab7bcb0ebf589c3b8e457fa62f76280e26d583f257015e0fc6b76bf9f413->enter($__internal_cdfdab7bcb0ebf589c3b8e457fa62f76280e26d583f257015e0fc6b76bf9f413_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_cdfdab7bcb0ebf589c3b8e457fa62f76280e26d583f257015e0fc6b76bf9f413->leave($__internal_cdfdab7bcb0ebf589c3b8e457fa62f76280e26d583f257015e0fc6b76bf9f413_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_7417a46dc914603f06fb0181a36a5f5adca1e49bdecf79323868882b13c2eb99 = $this->env->getExtension("native_profiler");
        $__internal_7417a46dc914603f06fb0181a36a5f5adca1e49bdecf79323868882b13c2eb99->enter($__internal_7417a46dc914603f06fb0181a36a5f5adca1e49bdecf79323868882b13c2eb99_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_7417a46dc914603f06fb0181a36a5f5adca1e49bdecf79323868882b13c2eb99->leave($__internal_7417a46dc914603f06fb0181a36a5f5adca1e49bdecf79323868882b13c2eb99_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_3bd2893cc36aae2e6cb6c1e2d4a22a2234a3e464775dc9a8705bb56221fbc60b = $this->env->getExtension("native_profiler");
        $__internal_3bd2893cc36aae2e6cb6c1e2d4a22a2234a3e464775dc9a8705bb56221fbc60b->enter($__internal_3bd2893cc36aae2e6cb6c1e2d4a22a2234a3e464775dc9a8705bb56221fbc60b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_3bd2893cc36aae2e6cb6c1e2d4a22a2234a3e464775dc9a8705bb56221fbc60b->leave($__internal_3bd2893cc36aae2e6cb6c1e2d4a22a2234a3e464775dc9a8705bb56221fbc60b_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_9847f36ed2d5881c24de6527200ce2ad8075c5291bd7f3770a4c84b90fdd338b = $this->env->getExtension("native_profiler");
        $__internal_9847f36ed2d5881c24de6527200ce2ad8075c5291bd7f3770a4c84b90fdd338b->enter($__internal_9847f36ed2d5881c24de6527200ce2ad8075c5291bd7f3770a4c84b90fdd338b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_9847f36ed2d5881c24de6527200ce2ad8075c5291bd7f3770a4c84b90fdd338b->leave($__internal_9847f36ed2d5881c24de6527200ce2ad8075c5291bd7f3770a4c84b90fdd338b_prof);

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
