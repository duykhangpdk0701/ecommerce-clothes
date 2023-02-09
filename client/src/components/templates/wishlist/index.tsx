import { Favorite } from "@mui/icons-material";
import React from "react";

const WishlistTemplate = () => {
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center">
          <Favorite className="text-2xl" />
          <h2 className="text-2xl">Wishlist</h2>
        </div>
      </div>
    </div>
  );
};

export default WishlistTemplate;
