<template>
    <div class="data-jemaat d-block">
      <section class="mt-5 content-around">
        <div class="container">
          <div class="row align-items-center desc-data-jemaat">
            <div class="col-md-8 px-5 column-data-jemaat">
                <div class="font-size-24 font-weight-700">
                  Lengkapi Data Diri Anda sebagai <br> Anggota Jemaat GKJ Yeremia
                </div>
                <div class="font-size-16 font-weight-500">
                  Anda dapat mengisi data diri dan mengakses detail data Anda melalui tombol di bawah ini.
                </div>
            </div>
            <div class="col-md-4 column-data-jemaat">
              <div class="image-data-jemaat">
                <img src="/assets/images/image-data-jemaat.jpg" style="width: 300px;">
              </div>
          </div>
        </div>
      </div>
      </section>
      <section class="mt-5 btn-bg-data-jemaat">
        <div class="container">
          <div class="text-center cta-main">
            <div class="cta-data-jemaat">
              <button type="button" onclick="window.location.href='#';" class="cta-btn mx-4 font-weight-600">Isi Data Diri</button>
              <button type="button" onclick="window.location.href='/detail_jemaat';" class="cta-btn mx-4 font-weight-600">Data Diri Saya</button>
            </div>
          </div>
          </div>
        </section>
    </div>
  </template>
  <style>
    .data-jemaat{
      margin: 25vh 0 15vh 0;
      display: block;
    }
    .btn-bg-data-jemaat{
      background-color: #BDCEFF;
      width: 75%;
      border-radius: 10px;
      margin: 0 auto;
      max-height: max-content;
    }
    .cta-main{
      padding: 3.5vh 0;
    }
    .cta-btn{
      width: 250px;
      background-color: #00227E;
      color: #fff;
      border: none;
      border-radius: 7px;
      height: 35px;
    }
    .cta-btn:hover{
      background-color: #00227E;
      opacity: 0.9;
      color: #fff;
      transition: 0.3s;
    }
    @media only screen and (max-width: 992px){
      .column-data-jemaat{
        width: 100%;
      }
      .desc-data-jemaat{
        text-align: center;
      }
      .image-data-jemaat{
        margin-top: 7.5%;
        display: flex;
        justify-content: center;
      }
      .btn-bg-data-jemaat{
        width: max-content;
      }
      .cta-main{
        padding: 1.75vh 0;
      }
      .cta-btn{
        width: 75%;
        margin: 0.25em;
      }
    }
    @media only screen and (max-width: 768px) {
      .image-data-jemaat{
        margin-top: 7.5%;
      }
      .desc-bg-data-jemaat{
        text-align: center;
        font-size: 14.25px;
      }
      .cta-main{
        font-size: 14.5px;
      }
    }
    @media only screen and (max-width: 600px){
      .image-data-jemaat{
        width: 250px;
        position: relative;
        left: 50%;
        transform: translateX(-50%);
      }
      .btn-bg-data-jemaat{
        max-height:15vh;
      }
      .desc-bg-data-jemaat{
        font-size: 13.5px;
      }
      .btn-bg-data-jemaat{
        width: 275px;
      }
      .cta-main{
        padding: 1vh 0;
      }
      .cta-btn{
        font-size: 14px;
      }
    }
  </style>