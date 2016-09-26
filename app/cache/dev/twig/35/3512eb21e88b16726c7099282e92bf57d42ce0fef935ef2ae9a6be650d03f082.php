<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_595272e8baea9f14f5ad3dd07271c314a4875fed1522c6e7c0eaae4241c09ea4 extends Twig_Template
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
        $__internal_054189590b8ae86b13e23d0ed4c630467ed3c5bc527ba0c6e18472023821b4ba = $this->env->getExtension("native_profiler");
        $__internal_054189590b8ae86b13e23d0ed4c630467ed3c5bc527ba0c6e18472023821b4ba->enter($__internal_054189590b8ae86b13e23d0ed4c630467ed3c5bc527ba0c6e18472023821b4ba_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_054189590b8ae86b13e23d0ed4c630467ed3c5bc527ba0c6e18472023821b4ba->leave($__internal_054189590b8ae86b13e23d0ed4c630467ed3c5bc527ba0c6e18472023821b4ba_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_5b13ed98330b3ff2d648a01c65616a82415be1784874ecf20f4cb22eeb93aeb8 = $this->env->getExtension("native_profiler");
        $__internal_5b13ed98330b3ff2d648a01c65616a82415be1784874ecf20f4cb22eeb93aeb8->enter($__internal_5b13ed98330b3ff2d648a01c65616a82415be1784874ecf20f4cb22eeb93aeb8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_5b13ed98330b3ff2d648a01c65616a82415be1784874ecf20f4cb22eeb93aeb8->leave($__internal_5b13ed98330b3ff2d648a01c65616a82415be1784874ecf20f4cb22eeb93aeb8_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_e5d878d27871d25666116a6ee8db783cd06c4cef6596a5910994fffc4b920273 = $this->env->getExtension("native_profiler");
        $__internal_e5d878d27871d25666116a6ee8db783cd06c4cef6596a5910994fffc4b920273->enter($__internal_e5d878d27871d25666116a6ee8db783cd06c4cef6596a5910994fffc4b920273_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_e5d878d27871d25666116a6ee8db783cd06c4cef6596a5910994fffc4b920273->leave($__internal_e5d878d27871d25666116a6ee8db783cd06c4cef6596a5910994fffc4b920273_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_06827f06a921d5e93a3b47a8eddcf1c551d1a407ce903f4fd48112c6be10b14a = $this->env->getExtension("native_profiler");
        $__internal_06827f06a921d5e93a3b47a8eddcf1c551d1a407ce903f4fd48112c6be10b14a->enter($__internal_06827f06a921d5e93a3b47a8eddcf1c551d1a407ce903f4fd48112c6be10b14a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_06827f06a921d5e93a3b47a8eddcf1c551d1a407ce903f4fd48112c6be10b14a->leave($__internal_06827f06a921d5e93a3b47a8eddcf1c551d1a407ce903f4fd48112c6be10b14a_prof);

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
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */
