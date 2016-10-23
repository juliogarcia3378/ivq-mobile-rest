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
        $__internal_4b4684ee67591eb7eb84011b22aaf90152070c9b87d8b20c2b3c9f3fa5055f68 = $this->env->getExtension("native_profiler");
        $__internal_4b4684ee67591eb7eb84011b22aaf90152070c9b87d8b20c2b3c9f3fa5055f68->enter($__internal_4b4684ee67591eb7eb84011b22aaf90152070c9b87d8b20c2b3c9f3fa5055f68_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_4b4684ee67591eb7eb84011b22aaf90152070c9b87d8b20c2b3c9f3fa5055f68->leave($__internal_4b4684ee67591eb7eb84011b22aaf90152070c9b87d8b20c2b3c9f3fa5055f68_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_a0f8efdabd5707168699b388c651666ce6a74c13e48e6959634e6f3362eac13f = $this->env->getExtension("native_profiler");
        $__internal_a0f8efdabd5707168699b388c651666ce6a74c13e48e6959634e6f3362eac13f->enter($__internal_a0f8efdabd5707168699b388c651666ce6a74c13e48e6959634e6f3362eac13f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_a0f8efdabd5707168699b388c651666ce6a74c13e48e6959634e6f3362eac13f->leave($__internal_a0f8efdabd5707168699b388c651666ce6a74c13e48e6959634e6f3362eac13f_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_64c5cdf01271f3d9c7d2d8542cec08019b405397bc76d6536758430afecd56c5 = $this->env->getExtension("native_profiler");
        $__internal_64c5cdf01271f3d9c7d2d8542cec08019b405397bc76d6536758430afecd56c5->enter($__internal_64c5cdf01271f3d9c7d2d8542cec08019b405397bc76d6536758430afecd56c5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_64c5cdf01271f3d9c7d2d8542cec08019b405397bc76d6536758430afecd56c5->leave($__internal_64c5cdf01271f3d9c7d2d8542cec08019b405397bc76d6536758430afecd56c5_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_627146f4b87e6236e47f048e1f695f8c49255f4b7c544abb3ff6650d5f6eba89 = $this->env->getExtension("native_profiler");
        $__internal_627146f4b87e6236e47f048e1f695f8c49255f4b7c544abb3ff6650d5f6eba89->enter($__internal_627146f4b87e6236e47f048e1f695f8c49255f4b7c544abb3ff6650d5f6eba89_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_627146f4b87e6236e47f048e1f695f8c49255f4b7c544abb3ff6650d5f6eba89->leave($__internal_627146f4b87e6236e47f048e1f695f8c49255f4b7c544abb3ff6650d5f6eba89_prof);

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
