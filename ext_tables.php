<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_btp_domain_model_team', 'EXT:btp/Resources/Private/Language/locallang_csh_tx_btp_domain_model_team.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_btp_domain_model_team');

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_btp_domain_model_expertise', 'EXT:btp/Resources/Private/Language/locallang_csh_tx_btp_domain_model_expertise.xlf');
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_btp_domain_model_expertise');
})();
