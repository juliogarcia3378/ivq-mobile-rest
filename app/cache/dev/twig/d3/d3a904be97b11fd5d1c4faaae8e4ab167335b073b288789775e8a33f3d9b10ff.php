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
        $__internal_ddbac88a2d139da9e45f8b959cf1dbc68778dd77def355666aba79992184290a = $this->env->getExtension("native_profiler");
        $__internal_ddbac88a2d139da9e45f8b959cf1dbc68778dd77def355666aba79992184290a->enter($__internal_ddbac88a2d139da9e45f8b959cf1dbc68778dd77def355666aba79992184290a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ddbac88a2d139da9e45f8b959cf1dbc68778dd77def355666aba79992184290a->leave($__internal_ddbac88a2d139da9e45f8b959cf1dbc68778dd77def355666aba79992184290a_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_8953dc3a27bd9f209ea3401c9a5961c1ac58e939ede34e5aef28a5d07da63826 = $this->env->getExtension("native_profiler");
        $__internal_8953dc3a27bd9f209ea3401c9a5961c1ac58e939ede34e5aef28a5d07da63826->enter($__internal_8953dc3a27bd9f209ea3401c9a5961c1ac58e939ede34e5aef28a5d07da63826_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_8953dc3a27bd9f209ea3401c9a5961c1ac58e939ede34e5aef28a5d07da63826->leave($__internal_8953dc3a27bd9f209ea3401c9a5961c1ac58e939ede34e5aef28a5d07da63826_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_05e8a4a184623518857179bdea58390827f4f97cd32002018c2a7cd82e9452c8 = $this->env->getExtension("native_profiler");
        $__internal_05e8a4a184623518857179bdea58390827f4f97cd32002018c2a7cd82e9452c8->enter($__internal_05e8a4a184623518857179bdea58390827f4f97cd32002018c2a7cd82e9452c8_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_05e8a4a184623518857179bdea58390827f4f97cd32002018c2a7cd82e9452c8->leave($__internal_05e8a4a184623518857179bdea58390827f4f97cd32002018c2a7cd82e9452c8_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_401575054f96b1fb9ab710c5daff04de9507897a2b239b47a29d933a2fc89453 = $this->env->getExtension("native_profiler");
        $__internal_401575054f96b1fb9ab710c5daff04de9507897a2b239b47a29d933a2fc89453->enter($__internal_401575054f96b1fb9ab710c5daff04de9507897a2b239b47a29d933a2fc89453_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_401575054f96b1fb9ab710c5daff04de9507897a2b239b47a29d933a2fc89453->leave($__internal_401575054f96b1fb9ab710c5daff04de9507897a2b239b47a29d933a2fc89453_prof);

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
