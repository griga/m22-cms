<?php
/** Created by griga at 30.06.2014 | 17:03.
 *
 */

use app\modules\translation\components\TranslationAsset;

TranslationAsset::register($this);

?>

<div class="row">
    <div class="col-sm-12" ng-app="TranslationApp" ng-controller="MainCtrl" id="translation-app" data-base-url="<?= $baseUrl ?>">
        <translation-loader loading="loading"></translation-loader>
        <div class="message-wrapper">
            <div class="message" style="display: none">
            </div>
        </div>
        <h4><?= \Yii::t('core', 'Translations') ?></h4>
        <ul class="nav nav-tabs">
            <li ng-repeat="category in categories" ng-class="{active: selectedCategory==category}"
                ><a ng-click="$parent.selectedCategory = category">{{category.name}}</a></li>
            <li ng-hide="loading" class="translation-filter">
                <input type="text" ng-model="searchValue" debounce="500" class="form-control">
                <i class="fa fa-search"></i>
                <i class="fa fa-remove" ng-show="searchValue" ng-click="searchValue=''"></i>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" ng-repeat="category in categories" ng-class="{active: selectedCategory==category}">
                <table class="table table-hover table-striped table-bordered table-condensed grid-view">
                    <thead>
                    <tr>
                        <th ng-repeat="(langKey, language) in languages">{{language}}</th>
                        <th class="translation-actions"><i ng-click="addPhrase()"
                                    class="fa fa-plus"></i></th>
                    </tr>
                    <!--  new phrases  -->
                    <tr ng-repeat="phrase in category.newPhrases" class="success">
                        <td ng-repeat="translation in phrase.translations ">
                            <textarea ng-model="translation.value" class="form-control"></textarea>
                        </td>
                        <td class="translation-actions">
                            <i ng-click="savePhrase(phrase)" class="fa fa-check"></i>
                            <i ng-click="cancelEdit(phrase)" class="fa fa-ban"></i>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                        <!-- phrases -->
                        <tr ng-repeat="phrase in category.phrases| filter: searchValue |orderBy:-translations.en">
                            <td ng-repeat="translation in phrase.translations ">
                                <span ng-bind="translation.value" ng-hide="phrase.edit"> </span>
                                <textarea ng-model="translation.value" ng-show="phrase.edit" class="form-control"></textarea>
                            </td>
                            <td class="translation-actions">
                                <i ng-click="editPhrase(phrase)" ng-hide="phrase.edit" class="fa fa-lg fa-pencil"></i>
                                <i ng-click="deletePhrase(phrase)" ng-hide="phrase.edit" class="fa fa-lg fa-trash"></i>
                                <i ng-click="copyPhrase(phrase)" ng-hide="phrase.edit" class="fa fa-lg fa-plus"></i>
                                <i ng-click="savePhrase(phrase)" ng-show="phrase.edit" class="fa fa-lg fa-check"></i>
                                <i ng-click="cancelEdit(phrase)" ng-show="phrase.edit" class="fa fa-lg fa-ban"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
