<?php

class Scanner
{
    /**
     * @var Lexer
     */
    private $lexer;

    /**
     * @var array
     */
    private $codifiedTable;

    /**
     * @var array
     */
    private $internalForm;

    /**
     * @var HashTable
     */
    private $identifiersTable;

    /**
     * @var HashTable
     */
    private $constantsTable;

    /**
     * Scanner constructor.
     *
     * @param string $input
     */
    public function __construct(string $input)
    {
        $this->lexer = new Lexer($input);
        $this->codifiedTable = require __DIR__.'/codified_table.php';
    }

    public function getTokens()
    {
        return iterator_to_array($this->lexer->getTokens());
    }

    public function scan()
    {
        $this->internalForm = [];
        $this->identifiersTable = new HashTable();
        $this->constantsTable = new HashTable();

        foreach ($this->lexer->getTokens() as $token) {
            switch ($token->getType()) {
                case Token::T_IDENTIFIER:
                    $this->addToTable($this->identifiersTable, $token);
                    break;
                case Token::T_CONSTANT:
                    $this->addToTable($this->constantsTable, $token);
                    break;
                default:
                    if (!isset($this->codifiedTable[$token->getValue()])) {
                        throw new Exception(sprintf('Unidentified token %s.', $token));
                    }

                    $this->internalForm[] = [
                        $this->codifiedTable[$token->getValue()],
                        -1,
                    ];
            }
        }
    }

    private function addToTable(HashTable $table, Token $token)
    {
        $code = $table->put($token->getValue());

        $this->internalForm[] = [
            $this->codifiedTable[$token->getType()],
            $code
        ];
    }

    /**
     * @return array
     */
    public function getInternalForm(): array
    {
        return $this->internalForm;
    }

    /**
     * @return HashTable
     */
    public function getIdentifiersTable(): HashTable
    {
        return $this->identifiersTable;
    }

    /**
     * @return HashTable
     */
    public function getConstantsTable(): HashTable
    {
        return $this->constantsTable;
    }
}