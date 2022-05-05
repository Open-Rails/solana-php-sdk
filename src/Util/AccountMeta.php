<?php

namespace Tighten\SolanaPhpSdk\Util;

use Tighten\SolanaPhpSdk\PublicKey;
use Tighten\SolanaPhpSdk\Util\Buffer;

class AccountMeta implements HasPublicKey
{
    public $pubkey;
    public bool $isSigner;
    public bool $isWritable;

    public function __construct($publicKey, $isSigner, $isWritable)
    {
        $this->isSigner = $isSigner;
        $this->isWritable = $isWritable;

        $str = Buffer::fromBase58($publicKey);
        $this->pubkey = $str->toArray();
    }

    public function getPublicKey(): PublicKey
    {
        return $this->publicKey;
    }
}
