<?php

/* @Twig/Exception/logs.html.twig */
class __TwigTemplate_e0a6b3e1ec0a55656e08855a6c6656d90d14630194478c06ba497356fd2fae50 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_4c419e2d1f5ce21c013df61910e9e6da8ba7e9dcc2b41c6e3d18d7ad0da26bed = $this->env->getExtension("native_profiler");
        $__internal_4c419e2d1f5ce21c013df61910e9e6da8ba7e9dcc2b41c6e3d18d7ad0da26bed->enter($__internal_4c419e2d1f5ce21c013df61910e9e6da8ba7e9dcc2b41c6e3d18d7ad0da26bed_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/logs.html.twig"));

        // line 1
        echo "<ol class=\"traces logs\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["logs"]) ? $context["logs"] : $this->getContext($context, "logs")));
        foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
            // line 3
            echo "        <li";
            if (($this->getAttribute($context["log"], "priority", array()) >= 400)) {
                echo " class=\"error\"";
            } elseif (($this->getAttribute($context["log"], "priority", array()) >= 300)) {
                echo " class=\"warning\"";
            }
            echo ">
            ";
            // line 4
            echo twig_escape_filter($this->env, $this->getAttribute($context["log"], "priorityName", array()), "html", null, true);
            echo " - ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["log"], "message", array()), "html", null, true);
            echo "
        </li>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</ol>
";
        
        $__internal_4c419e2d1f5ce21c013df61910e9e6da8ba7e9dcc2b41c6e3d18d7ad0da26bed->leave($__internal_4c419e2d1f5ce21c013df61910e9e6da8ba7e9dcc2b41c6e3d18d7ad0da26bed_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/logs.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 7,  38 => 4,  29 => 3,  25 => 2,  22 => 1,);
    }

    public function getSource()
    {
        return "<ol class=\"traces logs\">
    {% for log in logs %}
        <li{% if log.priority >= 400 %} class=\"error\"{% elseif log.priority >= 300 %} class=\"warning\"{% endif %}>
            {{ log.priorityName }} - {{ log.message }}
        </li>
    {% endfor %}
</ol>
";
    }
}
