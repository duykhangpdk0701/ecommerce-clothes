//mui component
import Container from "@mui/material/Container";
import Rating from "@mui/material/Rating";
import Button from "@mui/material/Button";
// mui Icon
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";

import Link from "next/link";
import React from "react";
import Slider from "react-slick";
import product_1 from "@/assets/images/products/product_1.jpg";
import Image from "next/image";

const DealOfTheDay = () => {
  return (
    <Container className="py-16">
      <div className="flex justify-between items-center mb-6">
        <h2>Deals Of The Day</h2>
        <Link href="/product" className="no-underline text-black">
          <span className="flex gap-2 items-center pb-1 font-semibold text-sm">
            Shop now <ArrowForwardIcon className="text-sm" />
          </span>
        </Link>
      </div>
      <div>
        <Slider slidesToShow={4} infinite>
          <div className="px-4">
            <div className="bg-white mx-auto">
              <div>
                <Link href={"/product"}>
                  <Image
                    src={product_1.src}
                    alt="product1"
                    height={225}
                    width={225}
                  />
                </Link>
              </div>
              <div className="p-4 text-center">
                <p className="text-sm">Silver High Neck Sweater</p>
                <h4 className="text-lg py-1">210,00 US$</h4>
                <div className="flex items-center justify-center gap-2 mb-4">
                  <Rating
                    name="read-only"
                    className="text-sm"
                    value={4}
                    readOnly
                  />
                  <small className="text-xs">({0})</small>
                </div>
                <Button variant="outlined" color="inherit" fullWidth>
                  Add To Cart
                </Button>
              </div>
            </div>
          </div>

          <div className="px-4">
            <div className="bg-white mx-auto">
              <div>
                <Link href={"/product"}>
                  <Image
                    src={product_1.src}
                    alt="product1"
                    height={225}
                    width={225}
                  />
                </Link>
              </div>
              <div className="p-4 text-center">
                <p className="text-sm">Silver High Neck Sweater</p>
                <h4 className="text-lg py-1">210,00 US$</h4>
                <div className="flex items-center justify-center gap-2 mb-4">
                  <Rating
                    name="read-only"
                    className="text-sm"
                    value={4}
                    readOnly
                  />
                  <small className="text-xs">({0})</small>
                </div>
                <Button variant="outlined" color="inherit" fullWidth>
                  Add To Cart
                </Button>
              </div>
            </div>
          </div>

          <div className="px-4">
            <div className="bg-white mx-auto">
              <div>
                <Link href={"/product"}>
                  <Image
                    src={product_1.src}
                    alt="product1"
                    height={225}
                    width={225}
                  />
                </Link>
              </div>
              <div className="p-4 text-center">
                <p className="text-sm">Silver High Neck Sweater</p>
                <h4 className="text-lg py-1">210,00 US$</h4>
                <div className="flex items-center justify-center gap-2 mb-4">
                  <Rating
                    name="read-only"
                    className="text-sm"
                    value={4}
                    readOnly
                  />
                  <small className="text-xs">({0})</small>
                </div>
                <Button variant="outlined" color="inherit" fullWidth>
                  Add To Cart
                </Button>
              </div>
            </div>
          </div>

          <div className="px-4">
            <div className="bg-white mx-auto">
              <div>
                <Link href={"/product"}>
                  <Image
                    src={product_1.src}
                    alt="product1"
                    height={225}
                    width={225}
                  />
                </Link>
              </div>
              <div className="p-4 text-center">
                <p className="text-sm">Silver High Neck Sweater</p>
                <h4 className="text-lg py-1">210,00 US$</h4>
                <div className="flex items-center justify-center gap-2 mb-4">
                  <Rating
                    name="read-only"
                    className="text-sm"
                    value={4}
                    readOnly
                  />
                  <small className="text-xs">({0})</small>
                </div>
                <Button variant="outlined" color="inherit" fullWidth>
                  Add To Cart
                </Button>
              </div>
            </div>
          </div>

          <div className="px-4">
            <div className="bg-white mx-auto">
              <div>
                <Link href={"/product"}>
                  <Image
                    src={product_1.src}
                    alt="product1"
                    height={225}
                    width={225}
                  />
                </Link>
              </div>
              <div className="p-4 text-center">
                <p className="text-sm">Silver High Neck Sweater</p>
                <h4 className="text-lg py-1">210,00 US$</h4>
                <div className="flex items-center justify-center gap-2 mb-4">
                  <Rating
                    name="read-only"
                    className="text-sm"
                    value={4}
                    readOnly
                  />
                  <small className="text-xs">({0})</small>
                </div>
                <Button variant="outlined" color="inherit" fullWidth>
                  Add To Cart
                </Button>
              </div>
            </div>
          </div>

          <div className="px-4">
            <div className="bg-white mx-auto">
              <div>
                <Link href={"/product"}>
                  <Image
                    src={product_1.src}
                    alt="product1"
                    height={225}
                    width={225}
                  />
                </Link>
              </div>
              <div className="p-4 text-center">
                <p className="text-sm">Silver High Neck Sweater</p>
                <h4 className="text-lg py-1">210,00 US$</h4>
                <div className="flex items-center justify-center gap-2 mb-4">
                  <Rating
                    name="read-only"
                    className="text-sm"
                    value={4}
                    readOnly
                  />
                  <small className="text-xs">({0})</small>
                </div>
                <Button variant="outlined" color="inherit" fullWidth>
                  Add To Cart
                </Button>
              </div>
            </div>
          </div>
        </Slider>
      </div>
    </Container>
  );
};

export default DealOfTheDay;
