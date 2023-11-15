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
          <div class="text-center py-4">
            <div class="font-weight-500 font-size-16 desc-bg-data-jemaat">
              Anda dapat melakukan login terlebih dahulu <br> sebelum melengkapi data diri.
            </div>
          </div>
          </div>
        </section>
    </div>
  </template>
  <style>
    .data-jemaat{
      margin: 25vh auto 15vh auto;
    }
    .btn-bg-data-jemaat{
      background-color: #BDCEFF;
      width: 75%;
      border-radius: 10px;
      margin: 0 auto;
      max-height: max-content;
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
        width: 70%;
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
    }
  </style>