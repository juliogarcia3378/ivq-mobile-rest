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
        $__internal_94f4194bacba5a7a0d00b2a7043be3175a1f7faba587fa0ab2705a6a037eba15 = $this->env->getExtension("native_profiler");
        $__internal_94f4194bacba5a7a0d00b2a7043be3175a1f7faba587fa0ab2705a6a037eba15->enter($__internal_94f4194bacba5a7a0d00b2a7043be3175a1f7faba587fa0ab2705a6a037eba15_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception.json.twig"));

        // line 1
        echo twig_jsonencode_filter(array("error" => array("code" => (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "message" => (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "exception" => $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "toarray", array()))));
        echo "
";
        
        $__internal_94f4194bacba5a7a0d00b2a7043be3175a1f7faba587fa0ab2705a6a037eba15->leave($__internal_94f4194bacba5a7a0d00b2a7043be3175a1f7faba587fa0ab2705a6a037eba15_prof);

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