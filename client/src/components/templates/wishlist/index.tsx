import FavoriteIcon from "@mui/icons-material/Favorite";
import React from "react";

const WishlistTemplate = () => {
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center">
          <FavoriteIcon className="text-2xl text-color-price" />
          <h2 className="text-2xl">Wishlist</h2>
        </div>
      </div>
    </div>
  );
};

export default WishlistTemplate;
