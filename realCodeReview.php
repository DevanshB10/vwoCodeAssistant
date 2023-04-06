public function getTriggerObject($eventFormat = false, $surveyTriggerObject = null) {
        if (!$surveyTriggerObject) {
            $triggerObject = $this->getCampaignPreference(company_domain_campaignPreference::DATA_KEY_TYPE_TRIGGER_OBJECT);
            if(!$triggerObject) {
                return null;
            }
            $triggerObject = json_decode($triggerObject->getDataValue(), true);
        } else {
            $triggerObject = $surveyTriggerObject;
        }
        if (!$eventFormat) {
            if ($triggerObject['type'] === 'saved') {
                $triggerId = $triggerObject['id'];
                $savedTriggerData = $this->getAccount()->getSavedTrigger($triggerId);
                $triggerData = $savedTriggerData->getTriggerObject();
                $triggerData['name'] = $savedTriggerData->getName();
                $triggerData['id'] = $triggerId;
                $triggerData['type'] = 'saved';
                if($triggerObject['segmentSettings']) {
                    $triggerData['segmentSettings'] = $triggerObject['segmentSettings'];
                }
                if ($triggerObject['isEventDrivenObject']) {
                    $triggerData['isEventDrivenObject'] = true;
                }
                $triggerObject = $triggerData;
            }
            return $triggerObject;
        }
        $returnObject['segmentSettings'] = $triggerObject['segmentSettings'];
        $returnObject['triggerCondition'] = $triggerObject['triggerCondition'];
        $returnObject['triggerObject'] = company_utilities_Segment::convertPartialSegments($triggerObject['partialSegments'], false);
        $updatedTriggerObject = $this->modifyTriggerPropsForPages($returnObject['triggerObject'], $triggerObject['type'], $triggerObject['id']);
        $returnObject['triggerObject'] = $updatedTriggerObject;
        return $returnObject;
    }