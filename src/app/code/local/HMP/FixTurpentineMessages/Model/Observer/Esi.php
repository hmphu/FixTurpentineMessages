<?php
class HMP_FixTurpentineMessages_Model_Observer_Esi extends Nexcessnet_Turpentine_Model_Observer_Esi{
	/**
     * Add the core/messages block rewrite if the flash message fix is enabled
     *
     * The core/messages block is rewritten because it doesn't use a template
     * we can replace with an ESI include tag, just dumps out a block of
     * hard-coded HTML and also frequently skips the toHtml method
     *
     * @param Varien_Object $eventObject
     * @return null
     */
    public function addMessagesBlockRewrite($eventObject) {
        if (Mage::helper('turpentine/esi')->shouldFixFlashMessages()) {
            Varien_Profiler::start('turpentine::observer::esi::addMessagesBlockRewrite');
            Mage::getSingleton('turpentine/shim_mage_core_app')
                ->shim_addClassRewrite('block', 'core', 'messages',
                    'HMP_FixTurpentineMessages_Block_Core_Messages');
            Varien_Profiler::stop('turpentine::observer::esi::addMessagesBlockRewrite');
        }
    }
}