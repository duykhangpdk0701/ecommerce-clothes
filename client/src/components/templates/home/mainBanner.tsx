import React from "react";
//mui component
import Container from "@mui/material/Container";
import Grid from "@mui/material/Grid";
import ButtonBase from "@mui/material/ButtonBase";
//mui icon
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";
//asset
import banner17 from "@/assets/home/banner/banner-17.jpg";
import banner16 from "@/assets/home/banner/banner-16.jpg";
import banner15 from "@/assets/home/banner/banner-15.jpg";
import banner25 from "@/assets/home/banner/banner-25.jpg";
//next
import Image from "next/image";
import Link from "next/link";
import Slider from "react-slick";

const HomeMainBanner = () => {
  return (
    <div className="pt-6">
      <Container>
        <Grid container>
          <Grid item xs={12} md={9}>
            <Slider dots slidesToShow={1} className="h-full">
              <div className="w-full h-[500px] relative">
                <Image
                  className="object-center"
                  fill
                  src={banner15.src}
                  alt="banner15"
                />
                <div className="absolute pl-20 top-0 h-full flex flex-col justify-center items-start">
                  <h4 className="uppercase text-3xl mb-2 font-normal">
                    Lifestyle collection
                  </h4>
                  <h1 className="uppercase text-6xl">men</h1>
                  <h4 className="uppercase text-3xl mt-2 font-semibold">
                    Sale up to <span className="text-color-price">30% Off</span>
                  </h4>
                  <p className="mb-8 text-lg">
                    Get Free Shipping on orders over $99.00
                  </p>
                  <ButtonBase
                    LinkComponent={Link}
                    href="/product"
                    className="text-white py-2.5 px-10 text-base bg-color-black"
                  >
                    Shop Now
                  </ButtonBase>
                </div>
              </div>
              <div className="relative h-[500px] w-full">
                <Image
                  fill
                  className="object-center"
                  src={banner25.src}
                  alt="banner25"
                />
                <div className="absolute pl-20 top-0 h-full flex flex-col justify-center items-start">
                  <h4 className="uppercase text-3xl mb-2 font-normal">
                    Lifestyle collection
                  </h4>
                  <h1 className="uppercase text-6xl">women</h1>
                  <h4 className="uppercase text-3xl mt-2 font-semibold">
                    Sale up to <span className="text-color-price">35% Off</span>
                  </h4>
                  <p className="mb-8 text-lg">
                    Get Free Shipping on orders over $99.00
                  </p>
                  <ButtonBase
                    LinkComponent={Link}
                    href="/product"
                    className="text-white py-2.5 px-10 text-base bg-color-black"
                  >
                    Shop Now
                  </ButtonBase>
                </div>
              </div>
            </Slider>
          </Grid>
          <Grid item xs={12} md={3}>
            <div className="flex flex-col">
              <div className="relative h-56">
                <Image
                  src={banner17.src}
                  alt="banner17"
                  className="object-cover"
                  fill
                />
                <div className="absolute top-0 left-8 h-full flex flex-col justify-center">
                  <p className="uppercase text-sm">New Arrivals</p>
                  <h4 className="mb-4 text-xl font-semibold uppercase">
                    Summber <br /> SALE 20% Off
                  </h4>
                  <Link href="/product" className="no-underline text-black">
                    <span className="flex gap-2 items-center pb-1 font-semibold text-sm">
                      Shop now <ArrowForwardIcon className="text-sm" />
                    </span>
                  </Link>
                </div>
              </div>
              <div className="relative h-56 mt-4">
                <Image
                  src={banner17.src}
                  alt="banner16"
                  className="object-cover"
                  fill
                />
                <div className="absolute top-0 left-8 h-full flex flex-col justify-center">
                  <p className="uppercase text-sm">New Arrivals</p>
                  <h4 className="mb-4 text-xl font-semibold uppercase">
                    Summber <br /> SALE 20% Off
                  </h4>
                  <Link href="/product" className="no-underline text-black">
                    <span className="flex gap-2 items-center pb-1 font-semibold text-sm">
                      Shop now <ArrowForwardIcon className="text-sm" />
                    </span>
                  </Link>
                </div>
              </div>
            </div>
          </Grid>
        </Grid>
      </Container>
    </div>
  );
};

export default HomeMainBanner;
