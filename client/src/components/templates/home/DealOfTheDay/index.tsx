//mui component
import Container from "@mui/material/Container";
// mui Icon
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";

import Link from "next/link";
import React, { Fragment } from "react";
import Slider from "react-slick";
import DealOfTheDayItem from "./item";
import { useQuery } from "react-query";
import itemAPI from "@/api/itemAPI";
import LoadingDealOfTheDayItem from "./loadingItem";

const DealOfTheDay = () => {
  const listItemQuery = useQuery({
    queryKey: ["item-deal-of-the-day"],
    queryFn: () => itemAPI.getListOfItem({}),
  });

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
        <Slider slidesToShow={4} infinite adaptiveHeight>
          {listItemQuery.isLoading
            ? Array(4).fill(<LoadingDealOfTheDayItem />)
            : listItemQuery.data?.map((item) => (
                <DealOfTheDayItem
                  slug={item.slug}
                  key={item.id}
                  name={item.name}
                  price={item.stock_lowest_price}
                  thumbnail={item.thumbnail_url}
                />
              ))}
        </Slider>
      </div>
    </Container>
  );
};

export default DealOfTheDay;
