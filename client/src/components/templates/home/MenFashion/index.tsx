import React, { Fragment } from "react";
//mui component
import Container from "@mui/material/Container";
//mui icon
import ArrowForwardIcon from "@mui/icons-material/ArrowForward";
import Link from "next/link";
import MenFashionItem from "./item";
import Slider from "react-slick";
import { useQuery } from "react-query";
import itemAPI from "@/api/itemAPI";
import LoadingMenItem from "./loadingItem";

const data = [<div>Loading</div>];

const MenFashion = () => {
  const listItemMenQuery = useQuery({
    queryKey: ["item-men"],
    queryFn: () => itemAPI.getListOfItemMen(),
  });

  return (
    <Container className="mb-16">
      <div className="flex justify-between items-center mb-6">
        <h2>Men's Fashion</h2>
        <Link
          href="/product?itemPersonType=1"
          className="no-underline text-black"
        >
          <span className="flex gap-2 items-center pb-1 font-semibold text-sm">
            Shop now <ArrowForwardIcon className="text-sm" />
          </span>
        </Link>
      </div>
      <div>
        <Slider slidesToShow={4} infinite adaptiveHeight>
          {listItemMenQuery.isLoading
            ? Array(4).fill(<LoadingMenItem />)
            : listItemMenQuery.data?.map((item) => (
                <MenFashionItem
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

export default MenFashion;
