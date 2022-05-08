<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Btp',
        'Team',
        [
            \WDB\Btp\Controller\TeamController::class => 'list, show',
            \WDB\Btp\Controller\ExpertiseController::class => 'list, show'
        ],
        // non-cacheable actions
        [
            \WDB\Btp\Controller\TeamController::class => '',
            \WDB\Btp\Controller\ExpertiseController::class => ''
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    team {
                        iconIdentifier = btp-plugin-team
                        title = LLL:EXT:btp/Resources/Private/Language/locallang_db.xlf:tx_btp_team.name
                        description = LLL:EXT:btp/Resources/Private/Language/locallang_db.xlf:tx_btp_team.description
                        tt_content_defValues {
                            CType = list
                            list_type = btp_team
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
