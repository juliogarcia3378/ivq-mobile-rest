<?php

/* @Twig/Exception/exception.json.twig */
class __TwigTemplate_44d6ec6c36f1e61265caec21dafca288112c9cadc1626f596ef62b789b2f9e05 extends Twig_Template
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
        $__internal_b9e2624f5f47c57bfd25014fe33165210b7ddf1f89f0544d0c82a1c3c3b3e97b = $this->env->getExtension("native_profiler");
        $__internal_b9e2624f5f47c57bfd25014fe33165210b7ddf1f89f0544d0c82a1c3c3b3e97b->enter($__internal_b9e2624f5f47c57bfd25014fe33165210b7ddf1f89f0544d0c82a1c3c3b3e97b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception.json.twig"));

        // line 1
        echo twig_jsonencode_filter(array("error" => array("code" => (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "message" => (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "exception" => $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "toarray", array()))));
        echo "
";
        
        $__internal_b9e2624f5f47c57bfd25014fe33165210b7ddf1f89f0544d0c82a1c3c3b3e97b->leave($__internal_b9e2624f5f47c57bfd25014fe33165210b7ddf1f89f0544d0c82a1c3c3b3e97b_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception.json.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 1,);
    }

    public function getSource()
    {
        return "{{ { 'error': { 'code': status_code, 'message': status_text, 'exception': exception.toarray } }|json_encode|raw }}
";
    }
}
