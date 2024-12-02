<?php

use BB\Signer;

/**
 * Class SignerTest
 */
class SignerTest extends \PHPUnit\Framework\TestCase
{
    private const
        CASES_TEST_SIGN = [
            [
                'secret_key' => '123451!oiu23hu7Y&*#@#B',
                'signature' => 'e2a75e0f073ca4bb622e0d3c7dfe33a910c0beefe022dd00c85026fd2f1ab7150d30fd84a074b5b78a27c611fad45bcecb104ca0069f0398faa6ce9e989dbe30',
                'request' => [
                    'meta' => [
                        'payment_id' => 'someId2',
                        'service_id' => 1231,
                        'signature' => 'some_generated_signature2'
                    ],
                    'payment' => [
                        'amount' => 10000,
                        'currency' => 'USD',
                    ],
                    'user' => [
                        'name' => null,
                        'surname' => null,
                        'phone' => null,
                        'mail' => 'somemail@box2.box'
                    ]
                ],
            ],
            [
                'secret_key' => '12345',
                'signature' => 'c7e484ff4a6260c91578ea2bf23c0a80aa870d3fb671fc8ca349c8e8ea8fe38fe47aca529062662a191152b94b94df62b9dbb779d023b11855c15aeaa22533f0',
                'request' => [
                    'meta' => [
                        'payment_id' => 'someId',
                        'service_id' => 1231,
                        'signature' => 'some_generated_signature'
                    ],
                    'payment' => [
                        'amount' => 10000,
                        'currency' => 'EUR',
                    ],
                    'user' => [
                        'name' => 'name',
                        'surname' => 'surname',
                        'phone' => '23214321312',
                        'mail' => 'somemail@box.box'
                    ]
                ],
            ],
            [
                'secret_key' => '123451!23#.4%..dasrew',
                'signature' => 'dff11096fc79fe3f05db2a6d22697f2250496fbd02d52ad4f22e395a231f3e7ec5f4a9ddc4ab8b1333758a008976d7a3907b07ec49002758477ec9a9bbbfbc61',
                'request' => [
                    'meta' => [
                        'payment_id' => 'someId2',
                        'service_id' => 1231,
                        'signature' => 'some_generated_signature2'
                    ],
                    'payment' => [
                        'amount' => 10000,
                        'currency' => 'USD',
                        'description' => 'some coool description'
                    ],
                    'user' => [
                        'name' => 'name2',
                        'surname' => 'surname2',
                        'phone' => '23214321312222',
                        'mail' => 'somemail@box2.box'
                    ]
                ],
            ],
        ];

    /**
     * @return void
     */
    public function testSign(): void
    {
        foreach (self::CASES_TEST_SIGN as $id => $case) {
            $signedRequest = Signer::sign($case['request'], $case['secret_key']);

            $this->assertTrue(Signer::validate($signedRequest, $case['secret_key']), 'check-signature-' . $id);
        }
    }
}
