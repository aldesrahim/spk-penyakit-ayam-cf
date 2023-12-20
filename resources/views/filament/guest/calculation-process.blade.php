<p class="text-xl mb-2">Rumus:</p>
<ol class="list-decimal ml-10">
    <li>
        <p>Rumus CF dasar:</p>
        <p><strong><code>CF[H, E] = MB[H, E] - MD[H, E]</code></strong></p>
    </li>
    <li>
        <p>Rumus CF dengan aturan:</p>
        <p><strong><code>CF[H, E] = CF[E] * CF[Rule]</code></strong></p>
    </li>
    <li>
        <p>Rumus CF kombinasi:</p>
        <ul class="list-disc ml-10">
            <li>
                <p>Jika <strong>kedua CF > 0</strong>, maka rumusnya adalah:</p>
                <p><strong><code>CF[H, E] = CF[lama] + CF[baru] (1 - CF[lama])</code></strong></p>
            </li>
            <li>
                <p>Jika <strong>kedua CF < 0</strong>, maka rumusnya adalah:</p>
                <p><strong><code>CF[H, E] = CF[lama] + CF[baru] (1 + CF[lama])</code></strong></p>
            </li>
            <li>
                <p>Jika <strong>kedua salah satu CF < 0</strong>, maka rumusnya adalah:</p>
                <p><strong><code>CF[H, E] = CF[lama] + CF[baru] / 1 - min(CF[lama] | CF[baru])</code></strong></p>
            </li>
        </ul>
    </li>
</ol>
<p class="text-xl mt-2 mb-2">Perhitungan CF:</p>
<ol class="list-decimal ml-10">
    @foreach($diseases as $item)
        <li>
            <p>{{ $item[0]->disease->name }}</p>
            <ul class="list-disc ml-10">
                @php
                    $iteration = 1;
                    $iterationCombination = 1;
                @endphp

                @foreach($item as $attribute)
                    @php
                        $label = filled($attribute->symptom_id) ? 'CF' : 'CFkombinasi';
                        $label .= filled($attribute->symptom_id) ? $iteration++ : $iterationCombination++;
                    @endphp
                    <li>
                        <p>{{ $label }}: <strong>{{ $attribute->certainty_factor + 0 }}</strong></p>

                        @if($loop->last)
                            <p>
                                <strong>
                                    @if(count($item) > 1)
                                        Karena CF lebih dari 1, maka harus dihitung CF kombinasinya. Dan hasil akhir CF Penyakit =
                                    @else
                                        Karena CF hanya 1, maka hasil akhir CF Penyakit =
                                    @endif
                                </strong>
                                <strong>
                                    {{ $attribute->certainty_factor + 0 }}
                                </strong>
                            </p>
                        @endif
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ol>
