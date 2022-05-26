<?php

namespace Tighten\SolanaPhpSdk\Programs;

use Tighten\SolanaPhpSdk\Program;
use Tighten\SolanaPhpSdk\PublicKey;
use Tighten\SolanaPhpSdk\TransactionInstruction;
use Tighten\SolanaPhpSdk\Util\AccountMeta;

class SplTokenProgram extends Program
{
    public const SOLANA_TOKEN_PROGRAM_ID = 'TokenkegQfeZyiNwAJbNbGKPFXCWuBvf9Ss623VQ5DA';

    /**
     * Public key that identifies the System program
     *
     * @return PublicKey
     */
    static function programId(): PublicKey
    {
        return new PublicKey(self::SOLANA_TOKEN_PROGRAM_ID);
    }

    /**
     * Generate a transaction instruction that transfers USDC from one account to another
     *
     * @param PublicKey $fromTokenAddres
     * @param PublicKey $toTokenAddress
     * @param PublicKey $fromPublicKey
     * @param int $usdc
     * @return TransactionInstruction
     */
    static public function createTransferInstruction(
        PublicKey $fromTokenAddress,
        PublicKey $toTokenAddress,
        PublicKey $fromPublicKey,
        int $usdc
    ): TransactionInstruction
    {
        $data = [
            // https://github.com/solana-labs/solana-program-library/blob/48fbb5b7/token/js/src/instructions/types.ts#L6
            // Transfer
            3,

            // int64
            ...unpack("C*", pack("P", $usdc))
        ];

        $keys = [
            new AccountMeta($fromTokenAddress, false, true),        // Sender's token account
            new AccountMeta($toTokenAddress, false, true),          // Receiver's token account
            new AccountMeta($fromPublicKey, true, false),           // Sender's pubkey
        ];

        return new TransactionInstruction(
            static::programId(),
            $keys,
            $data
        );
    }
}
