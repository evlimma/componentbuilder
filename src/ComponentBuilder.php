<?php

namespace evlimma\ComponentBuilder;

use EvLimma\ComponentBuilder\GenericFunction;

class ComponentBuilder
{
    use GenericFunction;

    public function titleBar(string $descricao, bool $accordion = false, ?string $classExtra = null, ?string $id = null): string
    {
        $typeAcoordion = [null, null];
        if ($accordion) {
            $typeAcoordion = ["href=''", "titSanfona"];
        }

        $retorno = "<a " . $typeAcoordion[0] . " class='btTitTipo " . $typeAcoordion[1] . " {$classExtra}' " . (($id) ? "id='{$id}'" : "") . ">
                        <aside>
                            <h4>{$descricao}</h4>
                        </aside>
                    </a>";

        return $retorno;
    }

    public function abaPesqIncluir(mixed $tit1 = [], mixed $tit2 = [], int $selectTit = 1): string
    {
        $retorno = "<div class='PesqIncluirGeral'>";

        if ($tit2) {
            $img = "<svg xmlns='http://www.w3.org/2000/svg' fill-rule='evenodd' viewBox='0 0 19.000002 19.000002'>
                        <g transform='translate(195.19149,-19.584835) matrix(0.02714286,0,0,0.02714286,-195.19149,15.733535)'>
                            <path d='m 545.37,313.78 c -74.81,74.75 -147.43,156.09 -228.85,226.44 -17.6,13.19 -41.8,15.39 -63.81,21.99 6.6,-19.79 5.4,-46.17 20.81,-63.76 68.21,-81.34 221.24,-226.44 227.84,-226.44 4.41,0 28.61,26.38 44.01,41.77 z m 68.22,-70.35 c -11,13.19 -26.41,28.58 -41.81,43.97 -13.2,-10.99 -28.61,-26.38 -44.01,-41.77 11,-13.19 26.41,-28.58 41.81,-43.97 13.2,10.99 28.61,26.38 44.01,41.77 z m 44.01,2.2 c 0,4.4 -204.65,226.44 -321.27,323.17 -30.81,26.38 -107.82,39.57 -114.43,39.57 -13.2,0 -15.4,-13.19 -15.4,-17.59 0,-4.39 17.6,-79.14 37.41,-112.12 11,-21.98 255.25,-259.41 316.87,-316.57 0,-2.2 4.4,-2.2 11,-2.2 8.8,0 85.82,76.95 85.82,85.74 z' />
                            <path d='m 420.71,219.84 c -22.5,-6.05 -45.91,-9.28 -69.76,-9.28 -158.31,0 -282.28,129.69 -282.28,282.28 0,154.5 129.7,280.38 282.28,280.38 160.22,0 280.38,-133.51 280.38,-286.1 0,-38.42 -8.55,-75.23 -23.77,-108.75 -0.21866,0.65599 41.01123,-44.19368 50.35,-51.99 C 681.33,377.3 700,431.7 700,490.94 700,683.58 541.69,841.89 349.05,841.89 156.4,841.89 0,683.58 0,492.84 0,298.29 156.4,141.89 349.05,141.89 c 45.79,0 89.98,8.33 130.11,24.77' />
                        </g>
                    </svg>";

            $retorno .= "<a class='incluirEditarGeral " . (($selectTit === 2) ? 'Atual' : '') . "' " . (($tit2[1]) ? "href='{$tit2[1]}'" : "") . " title='{$tit2[0]}'>
                            {$img}
                            <h3>{$tit2[0]}</h3>
                        </a>";
        }

        $retorno .= "</div>";

        return $retorno;
    }

    /**
     * 
     * @param string $nameIn
     * @param string $title
     * @param string|null $inValue
     * @param bool $required
     * @param string|null $disabledType         $disabledType pode ser 'disabled' ou 'readonly'
     * @param string $type                          'moeda', 'km', 'textarea', 'number' ...
     * @param bool $maskMoeda
     * @param string|null $classExtra
     * @param string|null $classPrincipal
     * @param bool $autoComplete
     * @param array $balloon                        $balloon = ["Política de Segurança para Senha", ["Tamanho mínimo de 4 caracteres;","Tamanho máximo de 40 caracteres;"]]
     * @param bool $passwordRevelation
     * @param string|null $iconLeft
     * @param string|null $btRightClass
     * @param string|null $attrNew
     * @param bool|null $btUpload
     * @param string|null $btNewTable
     * @return string
     */
    public function blocText(
        string $nameIn,
        ?string $title = null,
        ?string $inValue = null,
        bool $required = false,
        ?string $disabledType = null,
        string $type = "text",
        bool $maskMoeda = false,
        ?string $classExtra = null,
        ?string $classPrincipal = null,
        bool $autoComplete = true,
        ?array $balloon = null,
        bool $passwordRevelation = false,
        ?string $iconLeft = null,
        ?string $btRightClass = null,
        bool $fullWidth = false,
        ?string $attrNew = null,
        ?bool $btUpload = false,
        ?string $btNewTable = null,
        array $attributes = []
    ) {
        $asterisco = ($required) ? "*" : "";
        $requiredIf = ($required) ? "Sim" : "";
        $descolorido = (!empty($disabledType)) ? "caixaTransp" : "";
        $typeIf = ($type === "moeda" or $type === "km") ? "text" : $type;
        $maskKm = ($type === "km") ? "maskKm" : null;
        $corFonteVermelha = str_contains($classExtra ?? '', "fonteGeralVermelho") ? "fonteGeralVermelho" : "";
        $corFonteVerde = str_contains($classExtra ?? '', "fonteGeralVerde") ? "fonteGeralVerde" : "";
        $corFonteAlterar = (($corFonteVermelha != "") ? $corFonteVermelha : $corFonteVerde);
        $autoCompleteHTML = ($autoComplete) ? "" : "autocomplete='off' readonly onfocus=\"this.removeAttribute('readonly'); this.select();\"";
        $titleQuestion = ($this->right($title, 1) === "?") ? $title : $title . ":";
        $descoloridoFile = null;

        $activeIconLeft = ($iconLeft) ? "iconLeft" : "";
        $iconLeftImg = ($iconLeft) ? "url(\"{$iconLeft}\")" : "";

        // Concatena os atributos extras no input
        $extraAttributes = "";
        foreach ($attributes as $attr => $value) {
            $extraAttributes .= "{$attr}='{$value}' ";
        }

        $render = !$title ? "" : "<div class='caixa {$classPrincipal}' {$attrNew} style='" . ($fullWidth ? "width: 100%;" : "") . "'>";
        $iconRight = null;

        if ($balloon) {
            $render .= "<button class='ButDuvidaBalaoLab'></button>"
                . "<div class='MenuSuspensoDuvidaBalao'>"
                . "<strong>" . $balloon[0] . "</strong>"
                . "<ul>";
            foreach ($balloon[1] as $value) {
                $render .= "<li>{$value}</li>";
            }
            $render .= "</ul>"
                . "</div>";
        } else if ($btUpload) {
            $descoloridoFile = "caixaTransp";
            $iconRight = "iconRight";
            $disabledType = "readonly";
            $render .= "<button class='btUploadFile {$descolorido}'></button>"
                . "<input class='file_doc_annex clean' type='file' name='file_{$nameIn}'></input>";
        } else if ($btRightClass) {
            $iconRight = "iconRight";
            $render .= "<button class='{$btRightClass}'></button>";
        } else if ($passwordRevelation) {
            $iconRight = "iconRight";
            $render .= "<button class='btPasswordRevalation'></button>";
        }

        if ($title) {
            $render .= "<label class='labelForm {$descolorido}'>";
            $render .= ($btNewTable ? "<a href='{$btNewTable}' target='_blank' class='abrirNovaAba'>{$asterisco}{$title}:</a>" : "{$asterisco}{$titleQuestion}");
            $render .= "</label>";
        }

        $render .= (($maskMoeda) ? "<span class='Rcifrao {$descolorido} {$corFonteAlterar}'>R$</span>" : "");

        if ($type === "textarea") {
            $render .= "<textarea class='inputTextarea {$activeIconLeft} {$iconRight} {$classExtra} {$descolorido}' "
                . "name='{$nameIn}' {$disabledType} "
                . "obrigatorio='{$requiredIf}' bloqEnv='{$requiredIf}' "
                . "{$extraAttributes}>"
                . "{$inValue}"
                . "</textarea>";
        } else {
            $render .= "<input style='background-image: {$iconLeftImg};'"
                . "type='{$typeIf}' id='in{$nameIn}' "
                . "class='inputForm {$activeIconLeft} {$iconRight} {$classExtra} " . ($passwordRevelation ? "icoRight" : "") . " {$descolorido} {$descoloridoFile} " . (($maskMoeda) ? "maskMoney" : "") . " {$maskKm}' "
                . "name='in{$nameIn}' {$disabledType} {$autoCompleteHTML} "
                . "obrigatorio='{$requiredIf}' "
                . "bloqEnv='{$requiredIf}' "
                . "value='{$inValue}' "
                . "{$extraAttributes} />";
        }

        $render .= (!$title ? "" : "</div>");

        return $render;
    }


    /**
     * 
     * @param string $title
     * @param string $nameIn
     * @param string $urlAjax
     * @param string|null $inSeq
     * @param string|null $inValue
     * @param bool $required
     * @param string|null $disabledType         $disabledType pode ser 'disabled' ou 'readonly'
     * @param string|null $classExtra
     * @param string|null $classPrincipal
     * @param bool $typeSelect
     * @return type
     */
    public function blocSearchInput(
        string $nameIn,
        string $urlAjax,
        ?string $title = null,
        ?string $inSeq = null,
        ?string $inValue = null,
        bool $required = false,
        ?string $disabledType = null,
        ?string $classExtra = null,
        ?string $classPrincipal = null,
        ?string $idFilter = null,
        bool $typeSelect = false,
        bool $megaPopup = false,
        ?string $placeholder = null
    ) {
        $asterisco = ($required) ? "*" : "";
        $requiredIf = ($required) ? "Sim" : "";
        $descolorido = ($disabledType != "") ? "caixaTransp" : "";
        $pesquisarDbJs = ($disabledType) ? "" : "PesquisarDbJs";
        $classTypeSelect = ($typeSelect) ? "setaSelect" : "LupaPesquisaLab";
        $varDesabilitadoTipo = ($typeSelect) ? "readonly" : $disabledType;
        $clickTypeSelect = ($typeSelect) ? "clickTypeSelect" : "";
        $megaPopupClass = ($megaPopup) ? "megaPopup" : null;

        $render = (!$title ? "" : "<div class='caixa {$classPrincipal}'>")
            . "<button type='button' class='LupaPesquisaDb {$classTypeSelect} {$megaPopupClass}'></button>"
            . ($megaPopup ? "<button type='button' class='LupaPesquisaDb tblPesquisaLab btMegaPopup'></button>" : null)
            . "<ul class='MenuSuspensoDb'>"
            . "<li>Carregando...</li>"
            . "</ul>"

            . (!$title ? "" : "<label id='la{$nameIn}' class='labelForm {$descolorido}' for='txt{$nameIn}'>{$asterisco}{$title}:</label>")
            . "<input id='in{$nameIn}' type='hidden' class='seletorCampo' name='in{$nameIn}' value='{$inSeq}' />"
            . "<input id='txt{$nameIn}' "
            . "type='text' "
            . "placeholder='{$placeholder}' "
            . "class='inputForm PesquisarDb {$pesquisarDbJs} {$classExtra} {$descolorido} {$clickTypeSelect} {$megaPopupClass}' "
            . "autocomplete='off' name='txt{$nameIn}' {$varDesabilitadoTipo} "
            . "url='{$urlAjax}' idFilter='{$idFilter}' "
            . "valorBanco='{$inValue}' "
            . "obrigatorio='{$requiredIf}' bloqenv='{$requiredIf}' "
            . "value='{$inValue}' />"
            . (!$title ? "" : "</div>");

        return $render;
    }



    /**
     * 
     * @param string $nameIn
     * @param string $urlAjax
     * @param string $title
     * @param string|null $inSeq
     * @param string|null $inValue
     * @param bool $required
     * @param string|null $disabledtype         $disabledtype pode ser 'disabled' ou 'readonly'
     * @param string|null $classExtra
     * @param string|null $classMain
     * @param string|null $idFilter
     * @param string|null $groupInput
     * @return type
     */
    public function blocSelectAddLine(
        string $nameIn,
        string $urlAjax,
        ?string $title = null,
        ?string $inSeq = null,
        ?string $inValue = null,
        bool $required = false,
        ?string $disabledtype = null,
        ?string $classExtra = null,
        ?string $classMain = null,
        ?string $idFilter = null,
        ?string $groupInput = null
    ) {
        $asterisco = ($required) ? "*" : "";
        $requiredIf = ($required) ? "Sim" : "";
        $descolorido = ($disabledtype === "disabled") ? "caixaTransp" : "";

        $render = (!$title ? "" :
            "<div class='caixa {$classMain}'>")
            . "<button type='button' class='setaValidateDbVal'></button>"

            . (!$title ? "" : "<label class='labelForm {$descolorido}'>{$asterisco}{$title}:</label>")
            . "<input type='hidden' class='seletorCampo' name='in{$nameIn}' value='{$inSeq}' />"
            . "<input type='text' class='inputForm {$disabledtype} {$classExtra} {$descolorido} validateDbVal' "
            . "autocomplete='off' name='txt{$nameIn}' readonly "
            . "url='{$urlAjax}' idFilter='{$idFilter}' groupInput='{$groupInput}'"
            . "valorBanco='{$inValue}' "
            . "obrigatorio='{$requiredIf}' bloqenv='{$requiredIf}' "
            . "value='{$inValue}' />"
            . (!$title ? "" : "</div>");

        return $render;
    }

    /**
     * 
     * @param string $post
     * @param array|null $inValue
     * @param string $title
     * @param string $nameIn
     * @param array $arrValue           $arrValue = ['Ativo', 'Inativo'];<br>
     *                                  $arrValue = [[1, 'Ativo'], [2, 'Inativo']];<br>
     * @param string $required
     * @param string $nameClass
     * @param string $classMain
     * @param string|null $attrNew
     * @return string
     */
    public function blocRadio(
        ?string $post,
        string $title,
        string $nameIn,
        array $arrValue,
        ?string $inValue = null,
        bool $required = false,
        ?string $nameClass = null,
        ?string $classMain = null,
        bool $fullWidth = false,
        ?string $attrNew = null
    ): string {
        $asterisco = ($required) ? "*" : "";
        $requiredIf = ($required) ? "Sim" : "";
        $titleQuestion = ($this->right($title, 1) === "?") ? $title : $title . ":";

        $render = "<div class='caixa caixaCheck {$classMain}' {$attrNew} style='" . ($fullWidth ? "width: 100%;" : "") . "'>"
            . "<label class='labelForm'>{$asterisco}{$titleQuestion}</label>"
            . "<aside>";
        $i = 0;
        foreach ($arrValue as $list) {
            $value = (is_array($arrValue[0])) ? [$list[0], $list[1]] : [$list, $list];

            $checkedActual = null;
            if ($inValue !== null) {
                $checkedActual = ($inValue == $value[0] ? "checked" : "");
            } else if (!$post && $i === 0) {
                $checkedActual = "checked";
            }

            $render .= "<div>"
                . "<input "
                . "type='radio' "
                . "class='{$nameClass}' "
                . "name='in{$nameIn}' "
                . "id='in{$nameIn}{$i}' "
                . "obrigatorio='{$requiredIf}' "
                . "bloqenv='{$requiredIf}' "
                . "value='{$value[0]}' {$checkedActual}>"
                . "<label for='in{$nameIn}{$i}'>{$value[1]}</label></div>";
            $i++;
        }

        $render .= "</aside>
                    </div>";

        return $render;
    }

    /**
     * 
     * @param object|null $post
     * @return string
     */
    public function blocFilterPeriod(
        ?string $post,
        string $title,
        ?string $inPeriodo1 = null,
        ?string $inPeriodo2 = null,
    ): string {
        $render = "<div class='caixa inputFormPeriodo'>
                    <label id='laEmissao' class='labelForm' for='inEmissao'>{$title}:</label>
                    
                    <article>
                        <input id='inPeriodo1' type='date' class='inputForm focusPeriodo' name='inPeriodo1' value='" . ($post ? $inPeriodo1 : date("Y-m-01")) . "' />
                        <span class='separadorPeriodo'>-</span>
                        <input id='inPeriodo2' type='date' class='inputForm focusPeriodo' name='inPeriodo2' value='" . ($post ? $inPeriodo2 : date("Y-m-d")) . "' />
                    </article>
                </div>";

        return $render;
    }

    /**
     * blocCheckbox
     * @param string $post
     * @param array $inValue
     * @param string $title
     * @param string $nameIn
     * @param array $arrValue           $arrValue = ['Ativo', 'Inativo'];<br>
     *                                  $arrValue = [[1, 'Ativo'], [2, 'Inativo']];<br>
     * @param string $nomeclasse
     * @param string $classPrincipal
     * @return string
     */
    public function blocCheckbox(
        string $post,
        ?array $inValue,
        string $title,
        string $nameIn,
        array $arrValue,
        ?string $nomeclasse = null,
        ?string $classPrincipal = null
    ): string {
        $render = "<div class='caixa caixaCheck {$classPrincipal}'>"
            . "<label class='labelForm'>{$title}:</label>"
            . "<aside>";
        $i = 0;
        foreach ($arrValue as $list) {
            $value = (is_array($arrValue[0])) ? [$list[0], $list[1]] : [$list, $list];

            $checkedActual = null;
            if ($inValue) {
                $checkedActual = (in_array($value[0], $inValue) ? "checked" : "");
            } else if (!$post && $i === 0) {
                $checkedActual = "checked";
            }

            $render .= "<div>"
                . "<input "
                . "type='checkbox' "
                . "class='{$nomeclasse}' "
                . "name='in{$nameIn}[]' "
                . "id='in{$nameIn}{$i}' "
                . "value='{$value[0]}' {$checkedActual}>"
                . "<label for='in{$nameIn}{$i}'>{$value[1]}</label>"
                . "</div>";
            $i++;
        }
        $render .= "</aside>
                    </div>";

        return $render;
    }

    /**
     * 
     * @param string $title
     * @param string $nameIn
     * @param array|null $tblSearch          $tblSearch = ["Everton", "Bryan", "Fernanda"];<br>
     *                                       $tblSearch = [["1", "Everton"], ["2", "Bryan"], ["3", "Fernanda"]];<br>
     *                                       $tblSearch = (new UsuaLeftJoin())->findByActive();<br>
     * @param string|int|array|null $inValue
     * @param string $description       Se $tblSearch vir do banco preciso definir o campo que será o option
     * @param string $varValue          Se $tblSearch vir do banco preciso definir o campo  que será o value do option
     * @param bool $required
     * @param string $typeDisabled      pode ser 'disabled' ou 'readonly'
     * @param bool $multiple
     * @param bool $firstWhite
     * @param string $classExtra
     * @param string $classMain
     * @return string
     */
    public function blocSelect(
        string $title,
        string $nameIn,
        ?array $tblSearch,
        string|array|null $inValue = null,
        ?string $description = null,
        ?string $varValue = null,
        ?bool $required = null,
        ?string $typeDisabled = null,
        bool $multiple = false,
        bool $firstWhite = false,
        ?string $classExtra = null,
        ?string $classMain = null,
        ?string $information = null
    ): string {
        $asterisk = ($required) ? "*" : "";
        $requiredTag = ($required) ? "Sim" : "";
        $discolored = ($typeDisabled) ? "caixaTransp" : "";
        $multipleActive = (($multiple) ? "multiple" : "");
        $firstWhiteTag = (($firstWhite) ? "<option></option>" : "");
        $titleQuestion = ($this->right($title, 1) === "?") ? $title : $title . ":";
        $optionDescription = ($description) ?? "DESCRIPTION";
        $optionValue = ($varValue) ?? "VALUE";

        if (!empty($tblSearch) && is_string($tblSearch[0])) {
            foreach ($tblSearch as $list) {
                $lists[] = [$optionValue => $list, $optionDescription => $list];
            }
        } else if (!empty($tblSearch) && is_array($tblSearch[0])) {
            foreach ($tblSearch as $list) {
                $lists[] = [$optionValue => $list[0], $optionDescription => $list[1]];
            }
        } else if (!empty($tblSearch) && is_object($tblSearch[0])) {
            $lists = $tblSearch;
        }

        $inputHidden = ($inValue && $typeDisabled === "readonly") ? "<input type='hidden' name='in{$nameIn}' value='{$inValue}'>" : "";
        $selectName = "in{$nameIn}" . ($multiple ? "[]" : "");
        $selectDisabled = $typeDisabled ? "disabled" : "";
        $tagInformation = $information ? "<figure class='ico_information'> <span class='balloon'>{$information}</span></figure>" : null;

        $render = "<div class='caixa {$classMain}'>
                        <label class='labelForm {$discolored}' for='in{$nameIn}'>
                            {$asterisk}{$titleQuestion}{$tagInformation}
                        </label>

                        {$inputHidden}

                        <select class='{$classExtra} {$discolored}'
                                name='{$selectName}'
                                id='in{$nameIn}'
                                {$selectDisabled}
                                obrigatorio='{$requiredTag}'
                                bloqEnv='{$requiredTag}'
                                {$multipleActive}>
                            {$firstWhiteTag}";

        if ($tblSearch) {
            foreach ($lists as $v) {
                $v = (object)$v;

                if (is_array($inValue)) {
                    $txtInArr = in_array($v->{$optionValue}, $inValue);
                } else {
                    $txtInArr = (((string)$v->{$optionValue} === $inValue) ?? null);
                }

                $render .= "<option value='" . $v->{$optionValue} . "' " . (($txtInArr) ? "selected" : "") . ">"
                    . $v->{$optionDescription}
                    . "</option>";
            }
        }

        $render .= "</select></div>";

        return $render;
    }

    /**
     * 
     * @param string $value
     * @param string $name
     * @param bool $required
     * @param string|null $disabledType         'disabled' ou 'readonly'
     * @param string|null $classExtra
     * @return type
     */
    public function funBlocoTextarea(
        ?string $value,
        string $name,
        bool $required = false,
        ?string $disabledType = null,
        ?string $classExtra = null
    ): string {
        $retorno = "<textarea name='{$name}' " . ($required ? "required" : "") . " {$disabledType} class='caixaTextarea {$classExtra}'>{$value}</textarea>";

        return $retorno;
    }

    public function funSubtitle(?string $title): string
    {
        return "<div class='blocSubtitle'><h2>{$title}</h2></div>";
    }

    public function funAddInputHiddens(?array $addInputHidden): string
    {
        $inputHidden = "";
        foreach ($addInputHidden ?? [] as $key => $value) {
            $inputHidden .= "<input type='hidden' name='{$key}' value='{$value}'>";
        }

        return $inputHidden;
    }
}
