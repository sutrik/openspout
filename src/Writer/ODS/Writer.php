<?php

namespace OpenSpout\Writer\ODS;

use OpenSpout\Writer\Common\Entity\Options;
use OpenSpout\Writer\ODS\Creator\ManagerFactory;
use OpenSpout\Writer\ODS\Manager\OptionsManager;
use OpenSpout\Writer\WriterMultiSheetsAbstract;

/**
 * @extends WriterMultiSheetsAbstract<OptionsManager, ManagerFactory>
 */
final class Writer extends WriterMultiSheetsAbstract
{
    /** @var string Content-Type value for the header */
    protected static string $headerContentType = 'application/vnd.oasis.opendocument.spreadsheet';

    public function __construct(OptionsManager $optionsManager, ManagerFactory $managerFactory)
    {
        parent::__construct($optionsManager, $managerFactory);
    }

    public static function factory(): self
    {
        return new self(new OptionsManager(), new ManagerFactory());
    }

    /**
     * Sets a custom temporary folder for creating intermediate files/folders.
     * This must be set before opening the writer.
     *
     * @param string $tempFolder Temporary folder where the files to create the ODS will be stored
     *
     * @throws \OpenSpout\Writer\Exception\WriterAlreadyOpenedException If the writer was already opened
     */
    public function setTempFolder(string $tempFolder): void
    {
        $this->throwIfWriterAlreadyOpened('Writer must be configured before opening it.');

        $this->optionsManager->setOption(Options::TEMP_FOLDER, $tempFolder);
    }
}
