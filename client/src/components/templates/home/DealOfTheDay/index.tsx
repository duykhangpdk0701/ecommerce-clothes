//mui component
import Container from "@mui/material/Container";
// mui Icon
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";

import Link from "next/link";
import React, { Fragment } from "react";
import Slider from "react-slick";
import DealOfTheDayItem from "./item";

const data = [
  <DealOfTheDayItem />,
  <DealOfTheDayItem />,
  <DealOfTheDayItem />,
  <DealOfTheDayItem />,
];

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
          {data.map((item, index) => (
            <Fragment key={index}>{item}</Fragment>
          ))}
        </Slider>
      </div>
    </Container>
  );
};

export default DealOfTheDay;
