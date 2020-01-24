@extends('layouts.master')

@section('title','eBuy | Ödeme Sayfası')

@section('content')

    <div class="container">
        <div class="bg-content">
            <h2>Ödeme</h2>
            <form action="{{route('odeme')}}">
            <div class="row">
                <div class="col-md-5">
                    <h3>Ödeme Bilgileri</h3>
                    <div class="form-group">
                        <label for="kart_numarasi">Kredi Kartı Numarası</label>
                        <input type="text" class="form-control kredikarti" id="kartno" name="kart_numarasi" style="font-size:20px;" required>
                    </div>
                    <div class="form-group">
                        <label for="son_kullanma_tarihi_ay">Son Kullanma Tarihi</label>
                        <div class="row">
                            <div class="col-md-6">
                                Ay
                                <select name="son_kullanma_tarihi_ay" id="son_kullanma_tarihi_ay" class="form-control" required>
                                    @for($i=1;$i<=12;$i++)
                                    <option>{{$i}}</option>
                                        @endfor
                                </select>
                            </div>
                            <div class="col-md-6">
                                Yıl
                                <select name="son_kullanma_tarihi_yil" id="son_kullanma_tarihi_yil" class="form-control" required>
                                    @for($j=date('Y');$j<=date('Y')+10;$j++)
                                    <option>{{$j}}</option>
                                        @endfor
                                    @if($i<date('M')&&$j<date('Y'))
                                        Kart bilgilerinizi doğru girin lütfen.
                                        @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cardcvv2">CVV (Güvenlik Numarası)</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control kredikarti_cvv" name="cardcvv2" id="cardcvv2" required>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" checked> Ön bilgilendirme formunu okudum ve kabul ediyorum.</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" checked> Mesafeli satış sözleşmesini okudum ve kabul ediyorum.</label>
                            </div>
                        </div>
                    </form>
                    <button type="submit" class="btn btn-success btn-lg">Ödeme Yap</button>
                </div>
                <div class="col-md-7">
                    <h4>Ödenecek Tutar</h4>
                    <span class="price">18.92 <small>TL</small></span>

                    <h4>Kargo</h4>
                    <span class="price">0 <small>TL</small></span>

                    <h4>Teslimat Bilgileri</h4>
                    <p>Teslimat Adresi </p>
                    <a href="#">Değiştir</a>

                    <h4>Kargo</h4>
                    <p>Ücretsiz
                </div>
            </div>
            </form>

        </div>
    </div>

@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"></script>
    <script>
        $('.kredikarti').mask('0000-0000-0000-0000', { placeholder: "____-____-____-____" });
        $('.kredikarti_cvv').mask('000', { placeholder: "___" });
        $('.telefon').mask('(000) 000-00-00', { placeholder: "(___) ___-__-__" });
    </script>



@endsection
