<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_9cc1b770badc7ee5506df08e6663673720d5dbc3f3754b4a0da37a3ad6003cc4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e1ab2c8b4fb8a71eb71cb427b79b4a7160b6635fdfb7b59ab4ce8c0ca2db6785 = $this->env->getExtension("native_profiler");
        $__internal_e1ab2c8b4fb8a71eb71cb427b79b4a7160b6635fdfb7b59ab4ce8c0ca2db6785->enter($__internal_e1ab2c8b4fb8a71eb71cb427b79b4a7160b6635fdfb7b59ab4ce8c0ca2db6785_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e1ab2c8b4fb8a71eb71cb427b79b4a7160b6635fdfb7b59ab4ce8c0ca2db6785->leave($__internal_e1ab2c8b4fb8a71eb71cb427b79b4a7160b6635fdfb7b59ab4ce8c0ca2db6785_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_19fbd722bcec7a7b741191be14c1f06eddee27aee78501f809b4cf187bddcdc1 = $this->env->getExtension("native_profiler");
        $__internal_19fbd722bcec7a7b741191be14c1f06eddee27aee78501f809b4cf187bddcdc1->enter($__internal_19fbd722bcec7a7b741191be14c1f06eddee27aee78501f809b4cf187bddcdc1_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_19fbd722bcec7a7b741191be14c1f06eddee27aee78501f809b4cf187bddcdc1->leave($__internal_19fbd722bcec7a7b741191be14c1f06eddee27aee78501f809b4cf187bddcdc1_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_c2b87adfc692ecd2f3b66ff33648dd54932f6a6d00bb46fe6623be9393b76c09 = $this->env->getExtension("native_profiler");
        $__internal_c2b87adfc692ecd2f3b66ff33648dd54932f6a6d00bb46fe6623be9393b76c09->enter($__internal_c2b87adfc692ecd2f3b66ff33648dd54932f6a6d00bb46fe6623be9393b76c09_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_c2b87adfc692ecd2f3b66ff33648dd54932f6a6d00bb46fe6623be9393b76c09->leave($__internal_c2b87adfc692ecd2f3b66ff33648dd54932f6a6d00bb46fe6623be9393b76c09_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_a6141aee03eb1a122b3b5ee00dfef9d41e8d01fbf64d4e5130303d9d0e8569ea = $this->env->getExtension("native_profiler");
        $__internal_a6141aee03eb1a122b3b5ee00dfef9d41e8d01fbf64d4e5130303d9d0e8569ea->enter($__internal_a6141aee03eb1a122b3b5ee00dfef9d41e8d01fbf64d4e5130303d9d0e8569ea_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_a6141aee03eb1a122b3b5ee00dfef9d41e8d01fbf64d4e5130303d9d0e8569ea->leave($__internal_a6141aee03eb1a122b3b5ee00dfef9d41e8d01fbf64d4e5130303d9d0e8569ea_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }

    public function getSource()
    {
        return "{% extends '@WebProfiler/Profiler/layout.html.twig' %}

{% block toolbar %}{% endblock %}

{% block menu %}
<span class=\"label\">
    <span class=\"icon\">{{ include('@WebProfiler/Icon/router.svg') }}</span>
    <strong>Routing</strong>
</span>
{% endblock %}

{% block panel %}
    {{ render(path('_profiler_router', { token: token })) }}
{% endblock %}
";
    }
}
