<?php

namespace Tighten\SolanaPhpSdk;

use Tighten\SolanaPhpSdk\Util\AccountMeta;
use Tighten\SolanaPhpSdk\Util\Buffer;
use StephenHill\Base58;

class TransactionInstruction
{
    /**
     * @var array<AccountMeta>
     */
    public array $keys;
    public $programId;
    public $data;

    public function __construct(PublicKey $programId, array $keys, $data = null)
    {
        $base58 = new base58();
        $programId = Buffer::fromBase58($programId);
        $this->programId = $programId->toArray();
        $this->keys = $keys;
        $this->data = $data;
    }
}
