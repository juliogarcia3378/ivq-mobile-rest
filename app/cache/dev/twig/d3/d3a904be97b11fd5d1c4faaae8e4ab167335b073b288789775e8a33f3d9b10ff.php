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
        $__internal_e1667efab622960ea723abb820e745922a4629cac00b09178dc5aac06eb40e21 = $this->env->getExtension("native_profiler");
        $__internal_e1667efab622960ea723abb820e745922a4629cac00b09178dc5aac06eb40e21->enter($__internal_e1667efab622960ea723abb820e745922a4629cac00b09178dc5aac06eb40e21_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e1667efab622960ea723abb820e745922a4629cac00b09178dc5aac06eb40e21->leave($__internal_e1667efab622960ea723abb820e745922a4629cac00b09178dc5aac06eb40e21_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_e040e587f627ddded2e6bfe5bab2881b016d85c78c916a585fe594f7f4804f98 = $this->env->getExtension("native_profiler");
        $__internal_e040e587f627ddded2e6bfe5bab2881b016d85c78c916a585fe594f7f4804f98->enter($__internal_e040e587f627ddded2e6bfe5bab2881b016d85c78c916a585fe594f7f4804f98_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_e040e587f627ddded2e6bfe5bab2881b016d85c78c916a585fe594f7f4804f98->leave($__internal_e040e587f627ddded2e6bfe5bab2881b016d85c78c916a585fe594f7f4804f98_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_cb4ffb35f50fdfd021df3795ab491e218863de4b58a873f4fdf52279123ec71b = $this->env->getExtension("native_profiler");
        $__internal_cb4ffb35f50fdfd021df3795ab491e218863de4b58a873f4fdf52279123ec71b->enter($__internal_cb4ffb35f50fdfd021df3795ab491e218863de4b58a873f4fdf52279123ec71b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_cb4ffb35f50fdfd021df3795ab491e218863de4b58a873f4fdf52279123ec71b->leave($__internal_cb4ffb35f50fdfd021df3795ab491e218863de4b58a873f4fdf52279123ec71b_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_5546b64d233d4924e897bd0051f4d080da3540d4c9bc5d8a4c8ece4f77fea440 = $this->env->getExtension("native_profiler");
        $__internal_5546b64d233d4924e897bd0051f4d080da3540d4c9bc5d8a4c8ece4f77fea440->enter($__internal_5546b64d233d4924e897bd0051f4d080da3540d4c9bc5d8a4c8ece4f77fea440_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_5546b64d233d4924e897bd0051f4d080da3540d4c9bc5d8a4c8ece4f77fea440->leave($__internal_5546b64d233d4924e897bd0051f4d080da3540d4c9bc5d8a4c8ece4f77fea440_prof);

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
