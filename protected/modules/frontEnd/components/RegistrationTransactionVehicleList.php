<?php

class RegistrationTransactionVehicleList extends CComponent {

    public $dataProviderBranch1;
    public $dataProviderBranch2;
    public $dataProviderBranch3;
    public $dataProviderBranch4;
    public $dataProviderBranch5;
    public $dataProviderBranch6;
    public $dataProviderBranch7;

    public function __construct($dataProviderBranch1, $dataProviderBranch2, $dataProviderBranch3, $dataProviderBranch4, $dataProviderBranch5, $dataProviderBranch6, $dataProviderBranch7) {
        $this->dataProviderBranch1 = $dataProviderBranch1;
        $this->dataProviderBranch2 = $dataProviderBranch2;
        $this->dataProviderBranch3 = $dataProviderBranch3;
        $this->dataProviderBranch4 = $dataProviderBranch4;
        $this->dataProviderBranch5 = $dataProviderBranch5;
        $this->dataProviderBranch6 = $dataProviderBranch6;
        $this->dataProviderBranch7 = $dataProviderBranch7;
    }

    public function setupLoading() {
        $this->dataProviderBranch1->criteria->with = array(
            'vehicle',
        );
        $this->dataProviderBranch2->criteria->with = array(
            'vehicle',
        );
        $this->dataProviderBranch3->criteria->with = array(
            'vehicle',
        );
        $this->dataProviderBranch4->criteria->with = array(
            'vehicle',
        );
        $this->dataProviderBranch5->criteria->with = array(
            'vehicle',
        );
        $this->dataProviderBranch6->criteria->with = array(
            'vehicle',
        );
        $this->dataProviderBranch7->criteria->with = array(
            'vehicle',
        );
    }

    public function setupPaging($currentPage1, $currentPage2, $currentPage3, $currentPage4, $currentPage5, $currentPage6, $currentPage7) {
        $this->dataProviderBranch1->pagination->pageVar = 'page_branch_1';
        $this->dataProviderBranch2->pagination->pageVar = 'page_branch_2';
        $this->dataProviderBranch3->pagination->pageVar = 'page_branch_3';
        $this->dataProviderBranch4->pagination->pageVar = 'page_branch_4';
        $this->dataProviderBranch5->pagination->pageVar = 'page_branch_5';
        $this->dataProviderBranch6->pagination->pageVar = 'page_branch_6';
        $this->dataProviderBranch7->pagination->pageVar = 'page_branch_7';
        
        $this->dataProviderBranch1->pagination->pageSize = 50;
        $this->dataProviderBranch2->pagination->pageSize = 50;
        $this->dataProviderBranch3->pagination->pageSize = 50;
        $this->dataProviderBranch4->pagination->pageSize = 50;
        $this->dataProviderBranch5->pagination->pageSize = 50;
        $this->dataProviderBranch6->pagination->pageSize = 50;
        $this->dataProviderBranch7->pagination->pageSize = 50;

        $currentPage1 = (empty($currentPage1)) ? 0 : $currentPage1 - 1;
        $currentPage2 = (empty($currentPage2)) ? 0 : $currentPage2 - 1;
        $currentPage3 = (empty($currentPage3)) ? 0 : $currentPage3 - 1;
        $currentPage4 = (empty($currentPage4)) ? 0 : $currentPage4 - 1;
        $currentPage5 = (empty($currentPage5)) ? 0 : $currentPage5 - 1;
        $currentPage6 = (empty($currentPage6)) ? 0 : $currentPage6 - 1;
        $currentPage7 = (empty($currentPage7)) ? 0 : $currentPage7 - 1;
        $this->dataProviderBranch1->pagination->currentPage = $currentPage1;
        $this->dataProviderBranch2->pagination->currentPage = $currentPage2;
        $this->dataProviderBranch3->pagination->currentPage = $currentPage3;
        $this->dataProviderBranch4->pagination->currentPage = $currentPage4;
        $this->dataProviderBranch5->pagination->currentPage = $currentPage5;
        $this->dataProviderBranch6->pagination->currentPage = $currentPage6;
        $this->dataProviderBranch7->pagination->currentPage = $currentPage7;
    }

    public function setupSorting() {
        $this->dataProviderBranch1->sort->attributes = array('t.transaction_date');
        $this->dataProviderBranch2->sort->attributes = array('t.transaction_date');
        $this->dataProviderBranch3->sort->attributes = array('t.transaction_date');
        $this->dataProviderBranch4->sort->attributes = array('t.transaction_date');
        $this->dataProviderBranch5->sort->attributes = array('t.transaction_date');
        $this->dataProviderBranch6->sort->attributes = array('t.transaction_date');
        $this->dataProviderBranch7->sort->attributes = array('t.transaction_date');
        
        $this->dataProviderBranch1->criteria->order = $this->dataProviderBranch1->sort->orderBy;
        $this->dataProviderBranch2->criteria->order = $this->dataProviderBranch2->sort->orderBy;
        $this->dataProviderBranch3->criteria->order = $this->dataProviderBranch3->sort->orderBy;
        $this->dataProviderBranch4->criteria->order = $this->dataProviderBranch4->sort->orderBy;
        $this->dataProviderBranch5->criteria->order = $this->dataProviderBranch5->sort->orderBy;
        $this->dataProviderBranch6->criteria->order = $this->dataProviderBranch6->sort->orderBy;
        $this->dataProviderBranch7->criteria->order = $this->dataProviderBranch7->sort->orderBy;
    }

    public function setupFilter($startDate1, $endDate1, $startDate2, $endDate2, $startDate3, $endDate3, $startDate4, $endDate4, $startDate5, $endDate5, $startDate6, $endDate6, $startDate7, $endDate7) {
        $this->dataProviderBranch1->criteria->compare('t.branch_id', 1);
        $this->dataProviderBranch2->criteria->compare('t.branch_id', 2);
        $this->dataProviderBranch3->criteria->compare('t.branch_id', 3);
        $this->dataProviderBranch4->criteria->compare('t.branch_id', 4);
        $this->dataProviderBranch5->criteria->compare('t.branch_id', 5);
        $this->dataProviderBranch6->criteria->compare('t.branch_id', 7);
        $this->dataProviderBranch7->criteria->compare('t.branch_id', 9);
        
        $this->dataProviderBranch1->criteria->addBetweenCondition('t.transaction_date', $startDate1, $endDate1);
        $this->dataProviderBranch2->criteria->addBetweenCondition('t.transaction_date', $startDate2, $endDate2);
        $this->dataProviderBranch3->criteria->addBetweenCondition('t.transaction_date', $startDate3, $endDate3);
        $this->dataProviderBranch4->criteria->addBetweenCondition('t.transaction_date', $startDate4, $endDate4);
        $this->dataProviderBranch5->criteria->addBetweenCondition('t.transaction_date', $startDate5, $endDate5);
        $this->dataProviderBranch6->criteria->addBetweenCondition('t.transaction_date', $startDate6, $endDate6);
        $this->dataProviderBranch7->criteria->addBetweenCondition('t.transaction_date', $startDate7, $endDate7);
        
    }
}
